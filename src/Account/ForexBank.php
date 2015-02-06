<?php

namespace byrokrat\banking\Account;

/**
 * Forex Bank account
 */
class ForexBank extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_FOREX;
    }
}
