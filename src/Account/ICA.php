<?php

namespace byrokrat\banking\Account;

/**
 * ICA account
 */
class ICA extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_ICA;
    }
}
