<?php

declare(strict_types = 1);

namespace byrokrat\banking\Rewriter;

use byrokrat\banking\AccountNumber;
use byrokrat\banking\UndefinedAccount;

/**
 * Rewrite missplaced swedbank clearing number check digit
 */
class ClearingCheckDigitRewriter implements RewriterInterface
{
    public function rewrite(AccountNumber $account): AccountNumber
    {
        return new UndefinedAccount(
            $account->getRawNumber(),
            $account->getClearingNumber(),
            self::substr($account->getSerialNumber(), 0, 1),
            self::substr($account->getSerialNumber(), 1),
            $account->getCheckDigit()
        );
    }

    private static function substr(...$args): string
    {
        return (string)call_user_func_array('substr', $args);
    }
}
