<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class ForexBankTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'forex';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['9400,1111128', '9400', '', '111112', '8'],
        ];
    }
}
