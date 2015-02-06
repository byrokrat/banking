<?php

namespace byrokrat\banking\Account;

/**
 * AMFA account
 */
class AMFA extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_AMFA;
    }
}
