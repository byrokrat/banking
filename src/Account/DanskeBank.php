<?php

namespace byrokrat\banking\Account;

/**
 * DanskeBank account
 */
class DanskeBank extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_DANSKE;
    }
}
