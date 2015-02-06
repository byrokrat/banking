<?php

namespace byrokrat\banking\Account;

/**
 * Ålandsbanken account
 */
class Alandsbanken extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_ALANDSBANKEN;
    }
}
