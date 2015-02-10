<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class DNBTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'dnb';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['9190,1111131', '9190', '', '111113', '1'],
            ['9260,1111137', '9260', '', '111113', '7'],
        ];
    }
}
