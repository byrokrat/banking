<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class LandshypotekTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'landshypotek';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['9390,1111133', '9390', '', '111113', '3'],
        ];
    }
}
