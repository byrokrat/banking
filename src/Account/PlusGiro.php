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
        return $this->getSerialNumber() . '-' . $this->getCheckDigit();
    }

    public function getClearingNumber()
    {
        return '0000';
    }
}
