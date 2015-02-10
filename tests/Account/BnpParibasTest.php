<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class BnpParibasTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'bnp_paribas';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['9470,1111130', '9470', '', '111113', '0'],
        ];
    }
}
