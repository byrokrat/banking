<?php

namespace byrokrat\banking\Account;

/**
 * Landshypotek account
 */
class Landshypotek extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_LANDSHYPOTEK;
    }
}
