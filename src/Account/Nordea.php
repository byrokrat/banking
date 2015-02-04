<?php

namespace byrokrat\banking\Account;

/**
 * Nordea account
 */
class Nordea extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_NORDEA;
    }
}
