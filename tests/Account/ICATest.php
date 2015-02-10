<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class ICATest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'ica';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['9270,1111129', '9270', '', '111112', '9'],
        ];
    }
}
