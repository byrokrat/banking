<?php

declare(strict_types = 1);

namespace byrokrat\banking;

/**
 * @covers \byrokrat\banking\DelegatingFactory
 */
class DelegatingFactoryTest extends \PHPUnit\Framework\TestCase
{
    use \Prophecy\PhpUnit\ProphecyTrait;

    public function testDelegatesToFirstFactory()
    {
        $accountNumber = $this->createMock(AccountNumber::CLASS);

        $factory1 = $this->prophesize(AccountFactoryInterface::CLASS);
        $factory1->createAccount('123')->willReturn($accountNumber);

        $this->assertSame(
            $accountNumber,
            (new DelegatingFactory($factory1->reveal()))->createAccount('123')
        );
    }

    public function testDelegatesToSecondFactoryIfFirstFails()
    {
        $accountNumber = $this->createMock(AccountNumber::CLASS);

        $factory1 = $this->prophesize(AccountFactoryInterface::CLASS);
        $factory1->createAccount('123')->willThrow(new Exception\InvalidAccountNumberException);

        $factory2 = $this->prophesize(AccountFactoryInterface::CLASS);
        $factory2->createAccount('123')->willReturn($accountNumber);

        $this->assertSame(
            $accountNumber,
            (new DelegatingFactory($factory1->reveal(), $factory2->reveal()))->createAccount('123')
        );
    }

    public function testExceptionIfAllFactoriesFail()
    {
        $factory1 = $this->prophesize(AccountFactoryInterface::CLASS);
        $factory1->createAccount('123')->willThrow(new Exception\InvalidAccountNumberException);

        $this->expectException(Exception::CLASS);
        (new DelegatingFactory($factory1->reveal()))->createAccount('123');
    }
}
