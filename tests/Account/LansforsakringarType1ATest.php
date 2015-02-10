<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class LansforsakringarType1ATest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'lansforsakringar_1a';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['3400,1111128', '3400', '', '111112', '8'],
            ['9060,1111125', '9060', '', '111112', '5'],
        ];
    }
}
