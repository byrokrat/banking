<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class GeMoneyBankTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_GE_MONEY;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_GE_MONEY;
    }

    public function validProvider()
    {
        return [
            ['9460,1111129', '9460', '', '111112', '9'],
        ];
    }
}
