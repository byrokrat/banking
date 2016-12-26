<?php

namespace byrokrat\banking;

/**
 * Format of the unknown account
 */
class UnknownFormat extends Format
{
    public function __construct()
    {
        parent::__construct(
            BankNames::BANK_UNKNOWN,
            '/^([1-9]\d{3})(),?(\d{6,11})-?(\d)$/',
            'byrokrat\banking\BaseAccount',
            []
        );
    }
}
