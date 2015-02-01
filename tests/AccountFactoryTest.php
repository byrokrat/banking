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
        $this->assertSame(
            'Nordea',
            (new AccountFactory)->createAccount('3000,1111116')->getBankName()
        );
        $this->assertSame(
            'Unknown',
            (new AccountFactory)->createAccount('1000,1111116')->getBankName()
        );
    }

    public function testDisableUnknownAccount()
    {
        $this->setExpectedException('byrokrat\banking\Exception\UnableToCreateAccountException');
        $factory = new AccountFactory;
        $factory->disableUnknownAccount();
        $factory->createAccount('1000,1111116');
    }
}
