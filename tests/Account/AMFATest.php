<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\Account\AMFA
*/
class AMFATest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'AMFA';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\AMFA';
    }

    public function validProvider()
    {
        return [
            ['9660,1111130', '9660', '', '111113', '0'],
        ];
    }
}
