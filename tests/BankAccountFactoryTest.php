<?php

namespace ledgr\banking;

class BankAccountFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $this->assertInstanceOf(
            "ledgr\\banking\\NordeaPerson",
            BankAccountFactory::create('3300,1111111116')
        );
    }

    public function testCreateBankgiro()
    {
        $this->assertInstanceOf(
            "ledgr\\banking\\Bankgiro",
            BankAccountFactory::create('111-1111')
        );
    }

    public function testCreateBankgiroUnvalidCheckdigit()
    {
        $this->assertInstanceOf(
            "ledgr\\banking\\UnknownAccount",
            BankAccountFactory::create('111-1112')
        );
    }

    /**
     * @expectedException ledgr\banking\Exception
     */
    public function testClassMissingError()
    {
        // Clearing numbers must have 4 digits
        BankAccountFactory::create('12345,1');
    }
}
