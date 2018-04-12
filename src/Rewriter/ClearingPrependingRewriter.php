<?php

declare(strict_types = 1);

namespace byrokrat\banking\Rewriter;

use byrokrat\banking\AccountNumber;
use byrokrat\banking\UndefinedAccount;

/**
 * Rewriter that prepends a definied clearing number
 */
class ClearingPrependingRewriter implements RewriterInterface
{
    /**
     * @var string
     */
    private $clearing;

    public function __construct(string $clearing)
    {
        $this->clearing = $clearing;
    }

    public function rewrite(AccountNumber $account): AccountNumber
    {
        return new UndefinedAccount(
            $this->clearing,
            '',
            $account->getClearingNumber() . $account->getClearingCheckDigit() . $account->getSerialNumber(),
            $account->getCheckDigit()
        );
    }
}
