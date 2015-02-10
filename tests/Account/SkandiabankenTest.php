<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class SkandiabankenTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'skandiabanken';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['9150,1111134', '9150', '', '111113', '4'],
        ];
    }
}
