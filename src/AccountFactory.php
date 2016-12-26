<?php

namespace byrokrat\banking;

use byrokrat\banking\Rewriter\RewriterStrategy;
use byrokrat\banking\Rewriter\ClearingSeparatorRewriter;
use byrokrat\banking\Rewriter\SwedbankCheckDigitRewriter;
use byrokrat\banking\Exception\UnableToCreateAccountException;
use byrokrat\banking\Exception\InvalidAccountNumberException;

/**
 * Account number factory
 */
class AccountFactory
{
    /**
     * @var Format[] Loaded formats
     */
    private $formats;

    /**
     * @var RewriterStrategy[] Strategies for rewriting failing account numbers
     */
    private $rewriteStrategies;

    /**
     * @var bool Flag if rewrites should be allowed when creating account objects
     */
    private $allowRewrites;

    /**
     * @var UnknownFormat The unknown format or null if unknown is disallowed
     */
    private $unknownFormat;

    /**
     * @param Format[]           $formats
     * @param RewriterStrategy[] $rewrites
     * @param boolean            $allowRewrites Flag if rewrites should be allowed when creating account objects
     * @param boolean            $allowUnknown  Flag if the unknown account format should be used
     */
    public function __construct(array $formats = [], array $rewrites = [], $allowRewrites = true, $allowUnknown = true)
    {
        $this->formats = $formats ?: (new Formats)->createFormats();
        $this->rewriteStrategies = $rewrites ?: [new ClearingSeparatorRewriter, new SwedbankCheckDigitRewriter];
        $this->allowRewrites = $allowRewrites;
        $this->unknownFormat = $allowUnknown ? new UnknownFormat : null;
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
        $parseMap = $this->createParseMap($number);

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

        if ($this->unknownFormat) {
            try {
                return $this->unknownFormat->parse($number);
            } catch (InvalidAccountNumberException $exception) {
                // ignore failure to parse unknown account
            }
        }

        throw new UnableToCreateAccountException("Unable to parse account $number.");
    }

    /**
     * @param  string $number
     * @return array
     */
    private function createParseMap($number)
    {
        $parseMap = [
            'success' => [],
            'rewrite' => []
        ];

        $rewrites = array_map(
            function (RewriterStrategy $strategy) use ($number) {
                return $strategy->rewrite($number);
            },
            $this->rewriteStrategies
        );

        foreach ($this->formats as $format) {
            try {
                $parseMap['success'][] = $format->parse($number);
            } catch (InvalidAccountNumberException $exception) {
                foreach ($rewrites as $rewrite) {
                    try {
                        $parseMap['rewrite'][] = $format->parse($rewrite);
                    } catch (InvalidAccountNumberException $e) {
                        continue;
                    }
                }
            }
        }

        return $parseMap;
    }
}
