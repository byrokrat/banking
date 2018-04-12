<?php

declare(strict_types = 1);

namespace byrokrat\banking;

use byrokrat\banking\Format\FormatContainer;
use byrokrat\banking\Format\FormatFactory;
use byrokrat\banking\Rewriter\RewriterContainer;
use byrokrat\banking\Rewriter\RewriterFactory;
use byrokrat\banking\Exception\InvalidAccountNumberException;

/**
 * Account number factory for accounts using clearing numbers
 */
class AccountFactory implements AccountFactoryInterface
{
    /**
     * @var AccountFactoryInterface
     */
    private $decoratedFactory;

    /**
     * @var RewriterContainer
     */
    private $rewriters;

    /**
     * @var FormatContainer
     */
    private $formats;

    /**
     * @param AccountFactoryInterface $decorated Decorated account factory
     * @param RewriterContainer       $rewriters Rewriters used if parsed the raw account number fails
     * @param FormatContainer         $formats   Possible formats used when parsing account
     */
    public function __construct(
        AccountFactoryInterface $decorated = null,
        RewriterContainer $rewriters = null,
        FormatContainer $formats = null
    ) {
        $this->decoratedFactory = $decorated ?: new PermissiveFactory;
        $this->rewriters = $rewriters ?: (new RewriterFactory)->createRewriters();
        $this->formats = $formats ?: (new FormatFactory)->createFormats();
    }

    public function createAccount(string $number): AccountNumber
    {
        $account = $this->decoratedFactory->createAccount($number);

        $format = $this->formats->getFormatFromClearing($account);

        $result = $format->validate($account);

        if ($result->isValid()) {
            return new BankAccount($format->getBankName(), $account);
        }

        foreach ($this->rewriters as $rewriter) {
            $rewrittenAccount = $rewriter->rewrite($account);

            $rewrittenFormat = $this->formats->getFormatFromClearing($rewrittenAccount);

            if ($rewrittenFormat->validate($rewrittenAccount)->isValid()) {
                return new BankAccount($rewrittenFormat->getBankName(), $rewrittenAccount);
            }
        }

        throw new InvalidAccountNumberException(
            "Unable to parse account $number using format {$format->getBankName()}:\n{$result->getMessage()}"
        );
    }
}
