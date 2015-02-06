<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\Account\ForexBank
*/
class ForexBankTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'ForexBank';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\ForexBank';
    }

    public function validProvider()
    {
        return [
            ['9400,1111128', '9400', '', '111112', '8'],
        ];
    }
}
