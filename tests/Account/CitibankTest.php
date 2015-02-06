<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\Account\Citibank
*/
class CitibankTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'Citibank';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\Citibank';
    }

    public function validProvider()
    {
        return [
            ['9040,1111131', '9040', '', '111113', '1'],
        ];
    }
}
