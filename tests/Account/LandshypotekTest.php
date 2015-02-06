<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\Account\Landshypotek
*/
class LandshypotekTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'Landshypotek';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\Landshypotek';
    }

    public function validProvider()
    {
        return [
            ['9390,1111133', '9390', '', '111113', '3'],
        ];
    }
}
