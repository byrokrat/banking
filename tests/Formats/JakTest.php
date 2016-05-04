<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class JakTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_JAK;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_JAK;
    }

    public function validProvider()
    {
        return [
            ['9670,1111132', '9670', '', '111113', '2'],
            ['9679,1111137', '9679', '', '111113', '7'],
        ];
    }
}
