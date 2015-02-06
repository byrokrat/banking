<?php

namespace byrokrat\banking\Account;

/**
 * SBAB account
 */
class SBAB extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_SBAB;
    }
}
