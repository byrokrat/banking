<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class CitibankTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_CITIBANK;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_CITIBANK;
    }

    public function validProvider()
    {
        return [
            ['9040,1111131', '9040', '', '111113', '1'],
        ];
    }
}
