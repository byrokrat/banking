<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class NordnetTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_NORDNET;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_NORDNET;
    }

    public function validProvider()
    {
        return [
            ['9100,1111135', '9100', '', '111113', '5'],
        ];
    }
}
