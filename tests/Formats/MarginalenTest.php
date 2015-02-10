<?php

namespace byrokrat\banking;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class MarginalenTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_MARGINALEN;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_MARGINALEN;
    }

    public function validProvider()
    {
        return [
            ['9230,1111121', '9230', '', '111112', '1'],
        ];
    }
}
