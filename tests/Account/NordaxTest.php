<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\Account\Nordax
*/
class NordaxTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'Nordax';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\Nordax';
    }

    public function validProvider()
    {
        return [
            ['9640,1111137', '9640', '', '111113', '7'],
        ];
    }
}
