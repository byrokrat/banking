<?php

namespace byrokrat\banking;

class AccountFactoryOldTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $this->assertInstanceOf(
            "byrokrat\\banking\\NordeaPersonal",
            (new AccountFactoryOld)->create('3300,1111111116')
        );
    }

    public function testCreateBankgiro()
    {
        $this->assertInstanceOf(
            "byrokrat\\banking\\Bankgiro",
            (new AccountFactoryOld)->create('111-1111')
        );
    }

    public function testCreateBankgiroInvalidCheckdigit()
    {
        $this->setExpectedException('byrokrat\banking\Exception\UnableToCreateAccountException');
        (new AccountFactoryOld)->create('111-1112');
    }

    public function testClassMissingError()
    {
        $this->setExpectedException('byrokrat\banking\Exception\UnableToCreateAccountException');
        (new AccountFactoryOld)->create('12345,1');
    }
}
