<?php

declare(strict_types=1);

namespace byrokrat\banking\Rewriter;

use byrokrat\banking\AccountNumber;
use byrokrat\banking\UndefinedAccount;

/**
 * Rewriter that trims left side ceros from serial number
 */
class SerialTrimRewriter implements RewriterInterface
{
    /**
     * @var int
     */
    private $minimalLength;

    public function __construct(int $minimalLength = 0)
    {
        $this->minimalLength = $minimalLength;
    }

    public function rewrite(AccountNumber $account): AccountNumber
    {
        if ($this->minimalLength && strlen($account->getSerialNumber()) <= $this->minimalLength) {
            return $account;
        }

        return new UndefinedAccount(
            $account->getRawNumber(),
            $account->getClearingNumber(),
            $account->getClearingCheckDigit(),
            str_pad(ltrim($account->getSerialNumber(), '0'), $this->minimalLength, '0', STR_PAD_LEFT),
            $account->getCheckDigit()
        );
    }
}
