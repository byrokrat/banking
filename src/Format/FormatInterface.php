<?php

namespace byrokrat\banking\Format;

use byrokrat\banking\AccountNumber;
use byrokrat\banking\Validator\ValidatorInterface;

/**
 * Interface for bank account number formats
 */
interface FormatInterface extends ValidatorInterface
{
    /**
     * Get name of bank this format belongs to
     */
    public function getBankName(): string;

    /**
     * Check if clearing number is defined for this format
     */
    public function isValidClearing(AccountNumber $account): bool;
}
