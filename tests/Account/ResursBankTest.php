<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\Account\ResursBank
*/
class ResursBankTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'ResursBank';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\ResursBank';
    }

    public function validProvider()
    {
        return [
            ['9280,1111120', '9280', '', '111112', '0'],
        ];
    }
}
