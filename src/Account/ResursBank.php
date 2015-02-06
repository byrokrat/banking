<?php

namespace byrokrat\banking\Account;

/**
 * Resurs Bank account
 */
class ResursBank extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_RESURS;
    }
}
