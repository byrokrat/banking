<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class BnpParibasTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_BNP_PARIBAS;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_BNP_PARIBAS;
    }

    public function validProvider()
    {
        return [
            ['9470,1111130', '9470', '', '111113', '0'],
        ];
    }
}
