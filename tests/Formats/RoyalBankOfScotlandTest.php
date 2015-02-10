<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class RoyalBankOfScotlandTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_ROYAL_OF_SCOTLAND;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_ROYAL_OF_SCOTLAND;
    }

    public function validProvider()
    {
        return [
            ['9090,1111130', '9090', '', '111113', '0'],
        ];
    }
}
