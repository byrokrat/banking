<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class LansforsakringarType1ATest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_LANSFORSAKRINGAR_1A;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_LANSFORSAKRINGAR;
    }

    public function validProvider()
    {
        return [
            ['3400,1111128', '3400', '', '111112', '8'],
            ['9060,1111125', '9060', '', '111112', '5'],
        ];
    }
}
