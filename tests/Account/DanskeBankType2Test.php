<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\Account\DanskeBank
*/
class DanskeBankType2Test extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'DanskeBankType2';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\DanskeBank';
    }

    public function validProvider()
    {
        return [
            ['9180,1234567897', '9180', '', '123456789', '7'],
        ];
    }
}
