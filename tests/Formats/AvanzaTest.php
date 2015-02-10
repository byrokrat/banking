<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class AvanzaTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_AVANZA;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_AVANZA;
    }

    public function validProvider()
    {
        return [
            ['9550,1111138', '9550', '', '111113', '8'],
        ];
    }
}
