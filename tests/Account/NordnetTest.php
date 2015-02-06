<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\Account\Nordnet
*/
class NordnetTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'Nordnet';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\Nordnet';
    }

    public function validProvider()
    {
        return [
            ['9100,1111135', '9100', '', '111113', '5'],
        ];
    }
}
