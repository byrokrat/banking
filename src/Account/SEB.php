<?php

namespace byrokrat\banking\Account;

/**
 * SEB account
 */
class SEB extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_SEB;
    }
}
