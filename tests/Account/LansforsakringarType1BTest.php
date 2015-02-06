<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\Account\Lansforsakringar
*/
class LansforsakringarType1BTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'LansforsakringarType1B';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\Lansforsakringar';
    }

    public function validProvider()
    {
        return [
            ['9020,1111138', '9020', '', '111113', '8'],
        ];
    }
}
