<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class SkandiabankenTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_SKANDIABANKEN;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_SKANDIABANKEN;
    }

    public function validProvider()
    {
        return [
            ['9150,1111134', '9150', '', '111113', '4'],
        ];
    }
}
