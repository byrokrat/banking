<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class ErikPenserBankTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'erik_penser';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['9590,1111135', '9590', '', '111113', '5'],
        ];
    }
}
