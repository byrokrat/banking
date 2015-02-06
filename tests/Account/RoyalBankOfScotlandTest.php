<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\Account\RoyalBankOfScotland
*/
class RoyalBankOfScotlandTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'RoyalBankOfScotland';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\RoyalBankOfScotland';
    }

    public function validProvider()
    {
        return [
            ['9090,1111130', '9090', '', '111113', '0'],
        ];
    }
}
