<?php

namespace byrokrat\banking\Account;

/**
 * Sparbanken syd account
 */
class SparbankenSyd extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_SPARBANKEN_SYD;
    }
}
