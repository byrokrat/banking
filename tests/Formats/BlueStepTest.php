<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class BlueStepTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_BLUESTEP;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_BLUESTEP;
    }

    public function validProvider()
    {
        return [
            ['9680,1111124', '9680', '', '111112', '4'],
            ['9689,1111129', '9689', '', '111112', '9'],
        ];
    }
}
