<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class GeMoneyBankTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'ge_money_bank';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['9460,1111129', '9460', '', '111112', '9'],
        ];
    }
}
