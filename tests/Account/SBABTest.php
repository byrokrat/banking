<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class SBABTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'sbab';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['9250,1111125', '9250', '', '111112', '5'],
        ];
    }
}
