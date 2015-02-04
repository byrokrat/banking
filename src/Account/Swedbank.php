<?php

namespace byrokrat\banking\Account;

/**
 * Swedbank account
 */
class Swedbank extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_SWEDBANK;
    }
}
