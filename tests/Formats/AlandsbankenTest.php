<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class AlandsbankenTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_ALANDSBANKEN;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_ALANDSBANKEN;
    }

    public function validProvider()
    {
        return [
            ['2300,1111133', '2300', '', '111113', '3'],
        ];
    }
}
