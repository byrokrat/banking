<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class RiksgaldenType1Test extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_RIKSGALDEN_1;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_RIKSGALDEN;
    }

    public function validProvider()
    {
        return [
            ['9880,1111136', '9880', '', '111113', '6'],
        ];
    }
}
