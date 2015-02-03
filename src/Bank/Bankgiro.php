<?php

namespace byrokrat\banking\Bank;

use byrokrat\banking\AbstractAccount;

/**
 * Account number for Bankgirot clearing system
 */
class Bankgiro extends AbstractAccount implements Names
{
    public function getBankName()
    {
        return self::BANK_BANKGIRO;
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
