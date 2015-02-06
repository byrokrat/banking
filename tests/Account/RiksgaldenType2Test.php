<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\Account\Riksgalden
*/
class RiksgaldenType2Test extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'RiksgaldenType2';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\Riksgalden';
    }

    public function validProvider()
    {
        return [
            ['9890,1234567897', '9890', '', '123456789', '7'],
        ];
    }
}
