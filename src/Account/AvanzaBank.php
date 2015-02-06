<?php

namespace byrokrat\banking\Account;

/**
 * Avanza Bank account
 */
class AvanzaBank extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_AVANZA;
    }
}
