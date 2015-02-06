<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\Account\BnpParibas
*/
class BnpParibasTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'BnpParibas';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\BnpParibas';
    }

    public function validProvider()
    {
        return [
            ['9470,1111130', '9470', '', '111113', '0'],
        ];
    }
}
