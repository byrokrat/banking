<?php

namespace ledgr\banking;

class NullAccountTest extends \PHPUnit_Framework_TestCase
{
    public function testGetClearing()
    {
        $this->assertSame(
            '0000',
            (new NullAccount)->getClearing()
        );
    }

    public function testTo16()
    {
        $this->assertSame(
            '0000000000000000',
            (new NullAccount)->to16()
        );
    }

    public function testGetType()
    {
        $this->assertSame(
            '-',
            (new NullAccount)->getType()
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
