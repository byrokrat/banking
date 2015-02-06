<?php

namespace byrokrat\banking\Account;

/**
 * Riksgalden account
 */
class Riksgalden extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_RIKSGALDEN;
    }
}
