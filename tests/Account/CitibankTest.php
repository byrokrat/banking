<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class CitibankTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'citibank';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['9040,1111131', '9040', '', '111113', '1'],
        ];
    }
}
