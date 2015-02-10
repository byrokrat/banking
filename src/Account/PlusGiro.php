<?php

namespace byrokrat\banking\Account;

use byrokrat\banking\BaseAccount;

/**
 * Account number for PlusGirot clearing system
 */
class PlusGiro extends BaseAccount
{
    public function getNumber()
    {
        return ltrim(parent::getNumber(), '0,');
    }

    public function getClearingNumber()
    {
        return parent::getClearingNumber() ?: '0000';
    }
}
