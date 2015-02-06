<?php

namespace byrokrat\banking\Account;

/**
 * DNB account
 */
class DNB extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_DNB;
    }
}
