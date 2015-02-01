<?php

namespace byrokrat\banking\Bank;

use byrokrat\banking\AbstractAccount;

class Unknown extends AbstractAccount
{
    public function getBankName()
    {
        return 'Unknown';
    }
}
