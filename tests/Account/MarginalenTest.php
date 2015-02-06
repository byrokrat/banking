<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\Account\Marginalen
*/
class MarginalenTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'Marginalen';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\Marginalen';
    }

    public function validProvider()
    {
        return [
            ['9230,1111121', '9230', '', '111112', '1'],
        ];
    }
}
