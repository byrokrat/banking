<?php

namespace byrokrat\banking\Account;

/**
 * Marginalen bank account
 */
class Marginalen extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_MARGINALEN;
    }
}
