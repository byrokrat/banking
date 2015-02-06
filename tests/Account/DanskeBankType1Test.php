<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\Account\DanskeBank
*/
class DanskeBankType1Test extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'DanskeBankType1';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\DanskeBank';
    }

    public function validProvider()
    {
        return [
            ['1200,1111126', '1200', '', '111112', '6'],
            ['2400,1111128', '2400', '', '111112', '8'],
        ];
    }
}
