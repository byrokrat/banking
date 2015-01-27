<?php

namespace byrokrat\banking;

class NullAccountTest extends \PHPUnit_Framework_TestCase
{
    public function testGetClearingNumber()
    {
        $this->assertSame(
            '0000',
            (new NullAccount)->getClearingNumber()
        );
    }

    public function testGet16()
    {
        $this->assertSame(
            '0000000000000000',
            (new NullAccount)->get16()
        );
    }

    public function testGetBankName()
    {
        $this->assertSame(
            '-',
            (new NullAccount)->getBankName()
        );
    }

    public function testGetString()
    {
        NullAccount::setString('foobar');
        $this->assertSame(
            'foobar',
            (string)new NullAccount
        );
    }
}
