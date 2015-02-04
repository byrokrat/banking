<?php

namespace byrokrat\banking\Account;

/**
 * Unknown account
 */
class Unknown extends BaseAccount
{
    public function getBankName()
    {
        return 'Unknown';
    }
}
