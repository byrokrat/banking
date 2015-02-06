<?php

namespace byrokrat\banking\Account;

/**
 * Nordax account
 */
class Nordax extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_NORDAX;
    }
}
