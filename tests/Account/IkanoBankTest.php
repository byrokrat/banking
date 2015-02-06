<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\Account\IkanoBank
*/
class IkanoBankTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'IkanoBank';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\IkanoBank';
    }

    public function validProvider()
    {
        return [
            ['9170,1111128', '9170', '', '111112', '8'],
        ];
    }
}
