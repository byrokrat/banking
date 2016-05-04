<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class LanOchSparTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_LAN_OCH_SPAR;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_LAN_OCH_SPAR;
    }

    public function validProvider()
    {
        return [
            ['9630,1111125', '9630', '', '111112', '5'],
            ['9639,1111111', '9639', '', '111111', '1'],
        ];
    }
}
