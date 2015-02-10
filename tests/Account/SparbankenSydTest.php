<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class SparbankenSydTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'sparbanken_syd';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['9570,1234567897', '9570', '', '123456789', '7'],
        ];
    }
}
