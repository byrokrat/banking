<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class SantanderTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_SANTANDER;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_SANTANDER;
    }

    public function validProvider()
    {
        return [
            ['9460,1111129', '9460', '', '111112', '9'],
            ['9469,1111123', '9469', '', '111112', '3'],
        ];
    }
}
