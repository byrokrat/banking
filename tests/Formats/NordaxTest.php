<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class NordaxTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_NORDAX;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_NORDAX;
    }

    public function validProvider()
    {
        return [
            ['9640,1111137', '9640', '', '111113', '7'],
        ];
    }
}
