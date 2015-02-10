<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class SBABTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_SBAB;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_SBAB;
    }

    public function validProvider()
    {
        return [
            ['9250,1111125', '9250', '', '111112', '5'],
        ];
    }
}
