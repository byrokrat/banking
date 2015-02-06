<?php

namespace byrokrat\banking\Account;

/**
 * Lansforsakringar account
 */
class Lansforsakringar extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_LANSFORSAKRINGAR;
    }
}
