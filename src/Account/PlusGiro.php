<?php

namespace byrokrat\banking\Account;

/**
 * Account number for PlusGirot clearing system
 */
class PlusGiro extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_PLUSGIRO;
    }

    public function getNumber()
    {
        return ltrim(parent::getNumber(), '0,');
    }

    public function getClearingNumber()
    {
        return parent::getClearingNumber() ?: '0000';
    }
}
