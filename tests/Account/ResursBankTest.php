<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class ResursBankTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'resurs';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['9280,1111120', '9280', '', '111112', '0'],
        ];
    }
}
