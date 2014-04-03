<?php

namespace ledgr\banking;

class NullAccountTest extends \PHPUnit_Framework_TestCase
{
    public function testGetClearing()
    {
        $account = new NullAccount();
        $this->assertEquals('-', $account->getClearing());
    }

    public function testGetType()
    {
        $account = new NullAccount();
        $this->assertEquals('-', $account->getType());
    }

    public function testGetString()
    {
        NullAccount::setString('foobar');
        $account = new NullAccount();
        $this->assertEquals('foobar', (string)$account);
        $this->assertEquals('foobar', $account->getNumber());
        $this->assertEquals('foobar', $account->to16());
    }
}
