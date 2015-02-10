<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class DanskeBankType1Test extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'danske_bank_1';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['1200,1111126', '1200', '', '111112', '6'],
            ['2400,1111128', '2400', '', '111112', '8'],
        ];
    }
}
