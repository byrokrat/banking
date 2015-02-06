<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\Account\Skandiabanken
*/
class SkandiabankenTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'Skandiabanken';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\Skandiabanken';
    }

    public function validProvider()
    {
        return [
            ['9150,1111134', '9150', '', '111113', '4'],
        ];
    }
}
