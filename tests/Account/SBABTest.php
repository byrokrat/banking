<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\Account\SBAB
*/
class SBABTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'SBAB';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\SBAB';
    }

    public function validProvider()
    {
        return [
            ['9250,1111125', '9250', '', '111112', '5'],
        ];
    }
}
