<?php

namespace byrokrat\banking\Account;

/**
 * Skandiabanken account
 */
class Skandiabanken extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_SKANDIABANKEN;
    }
}
