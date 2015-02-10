<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class RoyalBankOfScotlandTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'royal_bank_of_scotland';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['9090,1111130', '9090', '', '111113', '0'],
        ];
    }
}
