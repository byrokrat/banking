<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class LandshypotekTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_LANDSHYPOTEK;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_LANDSHYPOTEK;
    }

    public function validProvider()
    {
        return [
            ['9390,1111133', '9390', '', '111113', '3'],
        ];
    }
}
