<?php

namespace byrokrat\banking\Account;

/**
 * Account number for Bankgirot clearing system
 */
class Bankgiro extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_BANKGIRO;
    }

    public function getNumber()
    {
        return sprintf(
            '%s-%s%s',
            substr($this->getSerialNumber(), 0, -3),
            substr($this->getSerialNumber(), -3),
            $this->getCheckDigit()
        );
    }

    public function getClearingNumber()
    {
        return '0000';
    }

    public function getSerialNumber()
    {
        return str_replace('-', '', parent::getSerialNumber());
    }
}
