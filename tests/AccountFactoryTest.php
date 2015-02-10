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

    public function testExceptionWhenInvalidCheckDigit()
    {
        $this->setExpectedException('byrokrat\banking\Exception\UnableToCreateAccountException');
        (new AccountFactory)->createAccount('3000,1111112');
    }

    public function testCreateNumbers()
    {
        $factory = new AccountFactory;
        $this->assertSame(
            BankNames::BANK_NORDEA,
            $factory->createAccount('3000,1111116')->getBankName()
        );
        $this->assertSame(
            BankNames::BANK_UNKNOWN,
            $factory->createAccount('1000,1111116')->getBankName()
        );
    }

    public function testBlacklist()
    {
        $this->setExpectedException('byrokrat\banking\Exception\UnableToCreateAccountException');
        $factory = new AccountFactory;
        $factory->blacklistFormats([BankNames::FORMAT_UNKNOWN]);
        $factory->createAccount('1000,1111116');
    }

    public function testWhitelist()
    {
        $factory = new AccountFactory;

        $this->assertSame(
            BankNames::BANK_PLUSGIRO,
            $factory->createAccount('58056201')->getBankName(),
            'When plusgiro is ENABLED 58056201 is considerad a valid plusgiro account'
        );

        $factory->whitelistFormats([BankNames::FORMAT_BANKGIRO]);

        $this->assertSame(
            BankNames::BANK_BANKGIRO,
            $factory->createAccount('58056201')->getBankName(),
            'When plusgiro is DISABLED 58056201 is considerad a valid bankgiro account'
        );
    }
}
