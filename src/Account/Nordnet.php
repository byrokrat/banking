<?php

namespace byrokrat\banking\Account;

/**
 * Nordnet account
 */
class Nordnet extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_NORDNET;
    }
}
