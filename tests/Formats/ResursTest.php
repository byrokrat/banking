<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class ResursTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_RESURS;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_RESURS;
    }

    public function validProvider()
    {
        return [
            ['9280,1111120', '9280', '', '111112', '0'],
        ];
    }
}
