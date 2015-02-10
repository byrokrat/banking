<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class DanskeBankType2Test extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'danske_bank_2';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['9180,1234567897', '9180', '', '123456789', '7'],
        ];
    }
}
