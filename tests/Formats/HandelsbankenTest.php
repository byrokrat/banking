<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class HandelsbankenTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_HANDELSBANKEN;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_HANDELSBANKEN;
    }

    public function validProvider()
    {
        return [
            ['6000,301286698', '6000', '', '30128669', '8'],
        ];
    }
}
