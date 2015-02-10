<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class SparbankenOresundTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_SPARBANKEN_ORESUND;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_SPARBANKEN_ORESUND;
    }

    public function validProvider()
    {
        return [
            ['9300,1234567897', '9300', '', '123456789', '7'],
            ['9349,1234567897', '9349', '', '123456789', '7'],
        ];
    }
}
