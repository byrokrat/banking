<?php

namespace byrokrat\banking;

/**
 * @covers \byrokrat\banking\AccountFactory
 */
class AccountFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testExceptionWhenUnableToCreate()
    {
        $this->setExpectedException('byrokrat\banking\Exception\UnableToCreateAccountException');
        (new AccountFactory)->createAccount('this-is-not-a-valid-number');
    }

    public function testCreateNumbers()
    {
        $factory = new AccountFactory;
        $this->assertSame(
            'Nordea',
            $factory->createAccount('3000,1111116')->getBankName()
        );
        $this->assertSame(
            'Unknown',
            $factory->createAccount('1000,1111116')->getBankName()
        );
    }

    public function testDisableFormat()
    {
        $this->setExpectedException('byrokrat\banking\Exception\UnableToCreateAccountException');
        $factory = new AccountFactory;
        $factory->disableFormat('Unknown');
        $factory->createAccount('1000,1111116');
    }
}
