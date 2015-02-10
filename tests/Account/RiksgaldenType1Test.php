<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class RiksgaldenType1Test extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'riksgalden_1';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['9880,1111136', '9880', '', '111113', '6'],
        ];
    }
}
