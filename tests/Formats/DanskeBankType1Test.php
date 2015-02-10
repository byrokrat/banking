<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class DanskeBankType1Test extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_DANSKE_1;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_DANSKE;
    }

    public function validProvider()
    {
        return [
            ['1200,1111126', '1200', '', '111112', '6'],
            ['2400,1111128', '2400', '', '111112', '8'],
        ];
    }
}
