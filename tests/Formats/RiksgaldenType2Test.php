<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class RiksgaldenType2Test extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_RIKSGALDEN_2;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_RIKSGALDEN;
    }

    public function validProvider()
    {
        return [
            ['9890,1234567897', '9890', '', '123456789', '7'],
        ];
    }
}
