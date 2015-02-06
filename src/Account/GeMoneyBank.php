<?php

namespace byrokrat\banking\Account;

/**
 * GE Money Bank account
 */
class GeMoneyBank extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_GE_MONEY;
    }
}
