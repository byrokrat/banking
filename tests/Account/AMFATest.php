<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class AMFATest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'amfa';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['9660,1111130', '9660', '', '111113', '0'],
        ];
    }
}
