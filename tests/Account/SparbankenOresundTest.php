<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class SparbankenOresundTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'sparbanken_oresund';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['9300,1234567897', '9300', '', '123456789', '7'],
            ['9349,1234567897', '9349', '', '123456789', '7'],
        ];
    }
}
