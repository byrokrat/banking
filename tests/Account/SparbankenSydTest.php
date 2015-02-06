<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\Account\SparbankenSyd
*/
class SparbankenSydTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'SparbankenSyd';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\SparbankenSyd';
    }

    public function validProvider()
    {
        return [
            ['9570,1234567897', '9570', '', '123456789', '7'],
        ];
    }
}
