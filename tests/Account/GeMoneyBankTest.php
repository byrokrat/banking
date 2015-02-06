<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\Account\GeMoneyBank
*/
class GeMoneyBankTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'GeMoneyBank';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\GeMoneyBank';
    }

    public function validProvider()
    {
        return [
            ['9460,1111129', '9460', '', '111112', '9'],
        ];
    }
}
