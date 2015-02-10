<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class ICATest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_ICA;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_ICA;
    }

    public function validProvider()
    {
        return [
            ['9270,1111129', '9270', '', '111112', '9'],
        ];
    }
}
