<?php

namespace byrokrat\banking\Account;

/**
 * BNP Paribas account
 */
class BnpParibas extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_BNP_PARIBAS;
    }
}
