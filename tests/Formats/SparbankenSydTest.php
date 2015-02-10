<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class SparbankenSydTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_SPARBANKEN_SYD;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_SPARBANKEN_SYD;
    }

    public function validProvider()
    {
        return [
            ['9570,1234567897', '9570', '', '123456789', '7'],
        ];
    }
}
