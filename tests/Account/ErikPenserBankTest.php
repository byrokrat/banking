<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\Account\ErikPenserBank
*/
class ErikPenserBankTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'ErikPenserBank';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\ErikPenserBank';
    }

    public function validProvider()
    {
        return [
            ['9590,1111135', '9590', '', '111113', '5'],
        ];
    }
}
