<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class IkanoBankTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'ikano';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['9170,1111128', '9170', '', '111112', '8'],
        ];
    }
}
