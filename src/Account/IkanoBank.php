<?php

namespace byrokrat\banking\Account;

/**
 * Ikano Bank account
 */
class IkanoBank extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_IKANO;
    }
}
