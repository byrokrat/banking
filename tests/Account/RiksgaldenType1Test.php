<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\Account\Riksgalden
*/
class RiksgaldenType1Test extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'RiksgaldenType1';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\Riksgalden';
    }

    public function validProvider()
    {
        return [
            ['9880,1111136', '9880', '', '111113', '6'],
        ];
    }
}
