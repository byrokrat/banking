<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class DNBTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_DNB;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_DNB;
    }

    public function validProvider()
    {
        return [
            ['9190,1111131', '9190', '', '111113', '1'],
            ['9260,1111137', '9260', '', '111113', '7'],
        ];
    }
}
