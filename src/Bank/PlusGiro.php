<?php

namespace byrokrat\banking\Bank;

use byrokrat\banking\AbstractAccount;

/**
 * Account number for PlusGirot clearing system
 */
class PlusGiro extends AbstractAccount implements Names
{
    public function getBankName()
    {
        return self::BANK_PLUSGIRO;
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
