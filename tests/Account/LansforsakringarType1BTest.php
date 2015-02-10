<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class LansforsakringarType1BTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'lansforsakringar_1b';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['9020,1111138', '9020', '', '111113', '8'],
        ];
    }
}
