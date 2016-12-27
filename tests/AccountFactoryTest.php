<?php

namespace byrokrat\banking;

use Prophecy\Argument;

/**
 * @covers \byrokrat\banking\AccountFactory
 */
class AccountFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateAccount()
    {
        $account = $this->prophesize('byrokrat\banking\AccountNumber')->reveal();

        $format = $this->prophesize('byrokrat\banking\Format');
        $format->parse('VALID')->willReturn($account);

        $factory = new AccountFactory([$format->reveal()]);

        $this->assertSame(
            $account,
            $factory->createAccount('VALID')
        );
    }

    public function testExceptionWhenMultipleFormatsMatch()
    {
        $account = $this->prophesize('byrokrat\banking\AccountNumber')->reveal();

        $formatA = $this->prophesize('byrokrat\banking\Format');
        $formatA->parse('FOOBAR')->willReturn($account);

        $formatB = $this->prophesize('byrokrat\banking\Format');
        $formatB->parse('FOOBAR')->willReturn($account);

        $factory = new AccountFactory([$formatA->reveal(), $formatB->reveal()]);

        $this->setExpectedException('byrokrat\banking\Exception\UnableToCreateAccountException');
        $factory->createAccount('FOOBAR');
    }

    public function testBlacklist()
    {
        $factory = new AccountFactory;
        $factory->blacklistFormats([BankNames::FORMAT_BANKGIRO]);

        $this->assertSame(
            BankNames::BANK_PLUSGIRO,
            $factory->createAccount('58056201')->getBankName(),
            'When bankgiro is BLACKLISTED 58056201 is considerad a valid plusgiro account'
        );
    }

    public function testWhitelist()
    {
        $factory = new AccountFactory;
        $factory->whitelistFormats([BankNames::FORMAT_BANKGIRO]);

        $this->assertSame(
            BankNames::BANK_BANKGIRO,
            $factory->createAccount('58056201')->getBankName(),
            'When bankgiro is WHITELISTED 58056201 is considerad a valid bankgiro account'
        );
    }

    public function testRewrite()
    {
        $account = $this->prophesize('byrokrat\banking\AccountNumber')->reveal();

        $format = $this->prophesize('byrokrat\banking\Format');
        $format->parse('NOT-VALID')->willThrow('byrokrat\banking\Exception\InvalidAccountNumberException');
        $format->parse('VALID')->willReturn($account);

        $rewriter = $this->prophesize('byrokrat\banking\Rewriter\RewriterStrategy');
        $rewriter->rewrite('NOT-VALID')->willReturn('VALID');

        $factory = new AccountFactory([$format->reveal()], [$rewriter->reveal()], true);

        $this->assertSame(
            $account,
            $factory->createAccount('NOT-VALID')
        );

        return [$account, $format, $rewriter];
    }

    /**
     * @depends testRewrite
     */
    public function testExceptionWhenMultipleRewritesMatch(array $setup)
    {
        list($account, $format, $rewriterA) = $setup;

        $rewriterB = $this->prophesize('byrokrat\banking\Rewriter\RewriterStrategy');
        $rewriterB->rewrite('NOT-VALID')->willReturn('VALID');

        $factory = new AccountFactory([$format->reveal()], [$rewriterA->reveal(), $rewriterB->reveal()], true);

        $this->setExpectedException('byrokrat\banking\Exception\UnableToCreateAccountException');
        $factory->createAccount('NOT-VALID');
    }

    /**
     * @depends testRewrite
     */
    public function testSuggestRewrite(array $setup)
    {
        list($account, $format, $rewriter) = $setup;

        $factory = new AccountFactory([$format->reveal()], [$rewriter->reveal()], false);

        $this->setExpectedException('byrokrat\banking\Exception\UnableToCreateAccountException');
        $factory->createAccount('NOT-VALID');
    }

    public function testUnknownFormatWhenNothingMatch()
    {
        $format = $this->prophesize('byrokrat\banking\Format');
        $format->parse(Argument::any())->willThrow('byrokrat\banking\Exception\InvalidClearingNumberException');

        $factory = new AccountFactory([$format->reveal()], [], true, true);

        $this->assertSame(
            BankNames::BANK_UNKNOWN,
            $factory->createAccount('1234,1234567')->getBankName()
        );
    }

    public function testIgnoringUnknownWhenCheckDigitFails()
    {
        $format = $this->prophesize('byrokrat\banking\Format');
        $format->parse(Argument::any())->willThrow('byrokrat\banking\Exception\InvalidCheckDigitException');

        $factory = new AccountFactory([$format->reveal()], [], true, true);

        $this->setExpectedException('byrokrat\banking\Exception\UnableToCreateAccountException');
        $factory->createAccount('1234,1234567');
    }

    public function testExceptionWhenUnableToCreate()
    {
        $format = $this->prophesize('byrokrat\banking\Format');
        $format->parse(Argument::any())->willThrow('byrokrat\banking\Exception\InvalidClearingNumberException');

        $factory = new AccountFactory([$format->reveal()], [], true, true);

        $this->setExpectedException('byrokrat\banking\Exception\UnableToCreateAccountException');
        $factory->createAccount('this-is-not-a-valid-number')->getBankName();
    }
}
