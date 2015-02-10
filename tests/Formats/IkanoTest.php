<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class IkanoTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_IKANO;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_IKANO;
    }

    public function validProvider()
    {
        return [
            ['9170,1111128', '9170', '', '111112', '8'],
        ];
    }
}
