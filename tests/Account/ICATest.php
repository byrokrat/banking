<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\Account\ICA
*/
class ICATest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'ICA';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\ICA';
    }

    public function validProvider()
    {
        return [
            ['9270,1111129', '9270', '', '111112', '9'],
        ];
    }
}
