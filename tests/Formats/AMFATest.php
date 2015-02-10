<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class AMFATest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_AMFA;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_AMFA;
    }

    public function validProvider()
    {
        return [
            ['9660,1111130', '9660', '', '111113', '0'],
        ];
    }
}
