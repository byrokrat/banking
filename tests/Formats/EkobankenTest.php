<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class EkobankenTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_EKOBANKEN;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_EKOBANKEN;
    }

    public function validProvider()
    {
        return [
            ['9700,1111130', '9700', '', '111113', '0'],
            ['9709,1111135', '9709', '', '111113', '5'],
        ];
    }
}
