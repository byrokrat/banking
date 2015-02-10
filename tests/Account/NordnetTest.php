<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class NordnetTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'nordnet';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['9100,1111135', '9100', '', '111113', '5'],
        ];
    }
}
