<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\Account\Lansforsakringar
*/
class LansforsakringarType1ATest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'LansforsakringarType1A';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\Lansforsakringar';
    }

    public function validProvider()
    {
        return [
            ['3400,1111128', '3400', '', '111112', '8'],
            ['9060,1111125', '9060', '', '111112', '5'],
        ];
    }
}
