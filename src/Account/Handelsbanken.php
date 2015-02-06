<?php

namespace byrokrat\banking\Account;

/**
 * Handelsbanken account
 */
class Handelsbanken extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_HANDELSBANKEN;
    }
}
