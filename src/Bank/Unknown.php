<?php

namespace byrokrat\banking\Bank;

use byrokrat\banking\AbstractAccount;

/**
 * Unknown account
 */
class Unknown extends AbstractAccount
{
    public function getBankName()
    {
        return 'Unknown';
    }
}
