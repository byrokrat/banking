<?php

namespace byrokrat\banking;

use byrokrat\banking\Exception\InvalidClearingNumberException;
use byrokrat\banking\Rewriter\RewriterStrategy;
use byrokrat\banking\Rewriter\RewriterFactory;
use byrokrat\banking\Exception\UnableToCreateAccountException;
use byrokrat\banking\Exception\InvalidAccountNumberException;
use byrokrat\banking\Exception\InvalidCheckDigitException;
use byrokrat\banking\Validator\ClearingValidator;

/**
 * Account number factory
 */
class AccountFactory
{
    /**
     * @var Format[] Possible formats used when parsing account
     */
    private $formats;

    /**
     * @var RewriterStrategy[] Strategies for rewriting failing account numbers
     */
    private $rewrites;

    /**
     * @var bool Flag if rewrites should be allowed when creating account objects
     */
    private $allowRewrites;

    /**
     * @var ?UnknownFormat The unknown format or null if unknown is disallowed
     */
    private $unknownFormat;

    /**
     * @var RewriterStrategy[] Preprocessors used to alter account before parsing starts
     */
    private $preprocessors;

    /**
     * @param Format[]           $formats       Possible formats used when parsing account
     * @param RewriterStrategy[] $rewrites      Rewrites used if parsed the raw account number fails
     * @param boolean            $allowRewrites Flag if rewrites should be allowed when creating account objects
     * @param boolean            $allowUnknown  Flag if the unknown account format should be used
     * @param RewriterStrategy[] $preprocessors Preprocessors used to alter account before parsing starts
     */
    public function __construct(
        array $formats = [],
        array $rewrites = null,
        $allowRewrites = true,
        $allowUnknown = true,
        $preprocessors = null
    ) {
        $this->formats = $formats ?: (new FormatFactory)->createFormats();
        $this->rewrites = is_array($rewrites) ? $rewrites : (new RewriterFactory)->createRewrites();
        $this->allowRewrites = $allowRewrites;
        $this->unknownFormat = $allowUnknown ? new UnknownFormat : null;
        $this->preprocessors = is_array($preprocessors) ? $preprocessors : (new RewriterFactory)->createPreprocessors();
    }

    /**
     * Enable formats
     *
     * Please note that formats not listed will be dropped and
     * can not be recovered.
     *
     * @param  string[] $formats List of formats to whitelist
     * @return null
     */
    public function whitelistFormats(array $formats)
    {
        foreach ($this->formats as $formatId => $format) {
            if (!in_array($formatId, $formats)) {
                unset($this->formats[$formatId]);
            }
        }
    }

    /**
     * Disable formats
     *
     * Please note that listed formats will be dropped and
     * can not be recovered.
     *
     * @param  string[] $formats List of formats to blacklist
     * @return null
     */
    public function blacklistFormats(array $formats)
    {
        foreach ($formats as $format) {
            unset($this->formats[$format]);
        }
    }

    /**
     * Create bank account object using number
     *
     * @param  string $number
     * @return AccountNumber
     * @throws UnableToCreateAccountException If unable to create
     */
    public function createAccount($number)
    {
        foreach ($this->preprocessors as $preprocessor) {
            $number = $preprocessor->rewrite($number);
        }

        $parseMap = [
            'success' => [],
            'rewrite' => [],
        ];

        /** @var ?\Exception $parseException */
        $parseException = null;

        $rewrites = array_map(
            function (RewriterStrategy $strategy) use ($number) {
                return $strategy->rewrite($number);
            },
            $this->rewrites
        );

        foreach ($this->formats as $format) {
            try {
                $parseMap['success'][] = $format->parse($number);
                continue;
            } catch (InvalidAccountNumberException $exception) {
                if ($exception instanceof InvalidCheckDigitException) {
                    $parseException = $exception;
                }

                if(!($exception instanceof InvalidClearingNumberException)) {
                   $clearing_validator = $format->get_validator(ClearingValidator::class);
                   if($clearing_validator) {
                      if($clearing_validator->validateClearingNumber($number)) {
                         $parseMap['exception'] = $exception;
                      }
                   }
                }

                foreach ($rewrites as $rewrite) {
                    try {
                        $parseMap['rewrite'][] = $format->parse($rewrite);
                    } catch (InvalidAccountNumberException $e) {
                        continue;
                    }
                }
            }
        }

        if (count($parseMap['success']) == 1) {
            return $parseMap['success'][0];
        }

        if (count($parseMap['success']) > 1) {
            throw new UnableToCreateAccountException(
                sprintf(
                    'Unable to parse account %s, multiple matching formats: %s.',
                    $number,
                    implode(
                        ' and ',
                        array_map(
                            function (AccountNumber $account) {
                                return $account->getBankName();
                            },
                            $parseMap['success']
                        )
                    )
                )
            );
        }

        if (count($parseMap['rewrite']) == 1 && $this->allowRewrites) {
            return $parseMap['rewrite'][0];
        }

        if ($parseMap['rewrite']) {
            throw new UnableToCreateAccountException(
                sprintf(
                    'Unable to parse account %s. You may rewrite number as: %s.',
                    $number,
                    implode(
                        ' or ',
                        array_map(
                            function (AccountNumber $account) {
                                return $account->getNumber();
                            },
                            $parseMap['rewrite']
                        )
                    )
                )
            );
        }

        if ($parseException) {
            throw new UnableToCreateAccountException(
                "Unable to parse account $number: {$parseException->getMessage()}",
                0,
                $parseException
            );
        }

        if ($this->unknownFormat) {
            try {
                return $this->unknownFormat->parse($number);
            } catch (InvalidAccountNumberException $exception) {
                // ignore failure to parse unknown account
            }
        }

        throw new UnableToCreateAccountException("Unable to parse account $number.");
    }
}
