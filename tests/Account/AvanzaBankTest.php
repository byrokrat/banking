<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class AvanzaBankTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'avanza';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['9550,1111138', '9550', '', '111113', '8'],
        ];
    }
}
