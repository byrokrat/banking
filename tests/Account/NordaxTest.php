<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class NordaxTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'nordax';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['9640,1111137', '9640', '', '111113', '7'],
        ];
    }
}
