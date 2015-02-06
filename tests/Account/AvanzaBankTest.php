<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\Account\AvanzaBank
*/
class AvanzaBankTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'AvanzaBank';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\AvanzaBank';
    }

    public function validProvider()
    {
        return [
            ['9550,1111138', '9550', '', '111113', '8'],
        ];
    }
}
