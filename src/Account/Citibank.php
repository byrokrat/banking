<?php

namespace byrokrat\banking\Account;

/**
 * Citibank account
 */
class Citibank extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_CITIBANK;
    }
}
