<?php

declare(strict_types = 1);

namespace byrokrat\banking;

use byrokrat\banking\Format\FormatInterface;
use byrokrat\banking\Format\FormatContainer;
use byrokrat\banking\Rewriter\RewriterInterface;
use byrokrat\banking\Rewriter\RewriterContainer;
use byrokrat\banking\Validator\Failure;
use byrokrat\banking\Validator\Success;
use byrokrat\banking\Exception\InvalidAccountNumberException;

/**
 * @covers \byrokrat\banking\AccountFactory
 */
class AccountFactoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @doesNotPerformAssertions
     */
    public function testInit()
    {
        $decoratedFactory = $this->prophesize(AccountFactoryInterface::CLASS);
        $rewriters = $this->prophesize(RewriterContainer::CLASS);
        $formats = $this->prophesize(FormatContainer::CLASS);

        $getAccountFactory = function () use ($decoratedFactory, $rewriters, $formats) {
            return new AccountFactory(
                $decoratedFactory->reveal(),
                $rewriters->reveal(),
                $formats->reveal()
            );
        };

        return [$getAccountFactory, $decoratedFactory, $formats, $rewriters];
    }

    /**
     * @depends testInit
     */
    public function testCreateAccount($setup)
    {
        list($getAccountFactory, $decoratedFactory, $formats) = $setup;

        $account = $this->createMock(AccountNumber::CLASS);
        $decoratedFactory->createAccount('raw')->willReturn($account);

        $format = $this->prophesize(FormatInterface::CLASS);
        $format->validate($account)->willReturn(new Success(''));
        $format->getBankName()->willReturn('bank');

        $formats->getFormatFromClearing($account)->willReturn($format->reveal());

        $this->assertEquals(
            new BankAccount('bank', $account),
            $getAccountFactory()->createAccount('raw')
        );
    }

    /**
     * @depends testInit
     */
    public function testRewrite($setup)
    {
        list($getAccountFactory, $decoratedFactory, $formats, $rewriters) = $setup;

        $account = $this->createMock(AccountNumber::CLASS);
        $decoratedFactory->createAccount('raw')->willReturn($account);

        $rewrittenAccount = $this->createMock(AccountNumber::CLASS);

        $format = $this->prophesize(FormatInterface::CLASS);
        $format->getBankName()->willReturn('bank');
        $format->validate($account)->willReturn(new Failure(''));
        $format->validate($rewrittenAccount)->willReturn(new Success(''));

        $formats->getFormatFromClearing($account)->willReturn($format->reveal())->shouldBeCalled();
        $formats->getFormatFromClearing($rewrittenAccount)->willReturn($format->reveal())->shouldBeCalled();

        $rewriter = $this->prophesize(RewriterInterface::CLASS);
        $rewriter->rewrite($account)->willReturn($rewrittenAccount);

        $rewriters->getIterator()->willReturn(new \ArrayIterator([$rewriter]));

        $this->assertEquals(
            new BankAccount('bank', $rewrittenAccount),
            $getAccountFactory()->createAccount('raw')
        );
    }

    /**
     * @depends testInit
     */
    public function testExceptionWhenUnableToCreate($setup)
    {
        list($getAccountFactory, $decoratedFactory, $formats, $rewriters) = $setup;

        $account = $this->createMock(AccountNumber::CLASS);
        $decoratedFactory->createAccount('raw')->willReturn($account);

        $format = $this->prophesize(FormatInterface::CLASS);
        $format->validate($account)->willReturn(new Failure(''));
        $format->getBankName()->willReturn('');

        $formats->getFormatFromClearing($account)->willReturn($format->reveal());

        $rewriters->getIterator()->willReturn(new \ArrayIterator([]));

        $this->expectException(Exception\InvalidAccountNumberException::CLASS);
        $getAccountFactory()->createAccount('raw');
    }

    public function testDefaultSetup()
    {
        $this->assertNotNull(new AccountFactory);
    }
}
