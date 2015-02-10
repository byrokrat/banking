<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class ForexTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_FOREX;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_FOREX;
    }

    public function validProvider()
    {
        return [
            ['9400,1111128', '9400', '', '111112', '8'],
        ];
    }
}
