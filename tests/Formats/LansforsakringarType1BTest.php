<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class LansforsakringarType1BTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_LANSFORSAKRINGAR_1B;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_LANSFORSAKRINGAR;
    }

    public function validProvider()
    {
        return [
            ['9020,1111138', '9020', '', '111113', '8'],
        ];
    }
}
