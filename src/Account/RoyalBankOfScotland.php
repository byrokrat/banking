<?php

namespace byrokrat\banking\Account;

/**
 * RoyalBankOfScotland account
 */
class RoyalBankOfScotland extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_ROYAL_OF_SCOTLAND;
    }
}
