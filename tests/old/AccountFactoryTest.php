<?php

namespace byrokrat\banking;

class AccountFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $this->assertInstanceOf(
            "byrokrat\\banking\\NordeaPersonal",
            (new AccountFactory)->create('3300,1111111116')
        );
    }

    public function testCreateSetClassList()
    {
        $this->assertInstanceOf(
            "byrokrat\\banking\\UnknownAccount",
            (new AccountFactory(['UnknownAccount']))->create('3300,1111111116')
        );
    }

    public function testCreateBankgiro()
    {
        $this->assertInstanceOf(
            "byrokrat\\banking\\Bankgiro",
            (new AccountFactory)->create('111-1111')
        );
    }

    public function testCreateBankgiroInvalidCheckdigit()
    {
        $this->setExpectedException('byrokrat\banking\Exception\UnableToCreateAccountException');
        (new AccountFactory)->create('111-1112');
    }

    public function testClassMissingError()
    {
        $this->setExpectedException('byrokrat\banking\Exception\UnableToCreateAccountException');
        (new AccountFactory)->create('12345,1');
    }
}
