<?php

namespace ledgr\banking;

class AccountFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $this->assertInstanceOf(
            "ledgr\\banking\\NordeaPersonal",
            (new AccountFactory)->create('3300,1111111116')
        );
    }

    public function testCreateSetClassList()
    {
        $this->assertInstanceOf(
            "ledgr\\banking\\UnknownAccount",
            (new AccountFactory(['UnknownAccount']))->create('3300,1111111116')
        );
    }

    public function testCreateBankgiro()
    {
        $this->assertInstanceOf(
            "ledgr\\banking\\Bankgiro",
            (new AccountFactory)->create('111-1111')
        );
    }

    public function testCreateBankgiroInvalidCheckdigit()
    {
        $this->setExpectedException('ledgr\banking\Exception\UnableToCreateAccountException');
        (new AccountFactory)->create('111-1112');
    }

    public function testClassMissingError()
    {
        $this->setExpectedException('ledgr\banking\Exception\UnableToCreateAccountException');
        (new AccountFactory)->create('12345,1');
    }
}
