<?php

namespace byrokrat\banking\Account;

/**
 * Erik Penser Bank account
 */
class ErikPenserBank extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_ERIK_PENSER;
    }
}
