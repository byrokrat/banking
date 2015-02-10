<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class MarginalenTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'marginalen';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['9230,1111121', '9230', '', '111112', '1'],
        ];
    }
}
