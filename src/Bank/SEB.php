<?php

namespace byrokrat\banking\Bank;

use byrokrat\banking\AbstractAccount;

class SEB extends AbstractAccount implements Names
{
    public function getBankName()
    {
        return self::BANK_SEB;
    }
}
