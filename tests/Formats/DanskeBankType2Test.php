<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class DanskeBankType2Test extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_DANSKE_2;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_DANSKE;
    }

    public function validProvider()
    {
        return [
            ['9180,1234567897', '9180', '', '123456789', '7'],
        ];
    }
}
