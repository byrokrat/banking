<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class ErikPenserTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_ERIK_PENSER;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_ERIK_PENSER;
    }

    public function validProvider()
    {
        return [
            ['9590,1111135', '9590', '', '111113', '5'],
        ];
    }
}
