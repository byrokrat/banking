<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class RiksgaldenType2Test extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'riksgalden_2';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['9890,1234567897', '9890', '', '123456789', '7'],
        ];
    }
}
