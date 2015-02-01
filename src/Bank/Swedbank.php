<?php

namespace byrokrat\banking\Bank;

use byrokrat\banking\AbstractAccount;

class Swedbank extends AbstractAccount implements Names
{
    public function getBankName()
    {
        return self::BANK_SWEDBANK;
    }
}
