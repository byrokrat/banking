<?php

declare(strict_types = 1);

namespace byrokrat\banking;

use Prophecy\Argument;

class BankAccountTest extends \PHPUnit\Framework\TestCase
{
    public function testBankName()
    {
        $this->assertSame(
            'bank',
            (new BankAccount('bank', $this->createMock(AccountNumber::CLASS)))->getBankName()
        );
    }

    public function testDecoration()
    {
        $decorated = $this->prophesize(AccountNumber::CLASS);

        $decorated->getRawNumber()->willReturn('raw');
        $decorated->getNumber()->willReturn('formatted');
        $decorated->getClearingNumber()->willReturn('clear');
        $decorated->getClearingCheckDigit()->willReturn('clearCheck');
        $decorated->getSerialNumber()->willReturn('serial');
        $decorated->getCheckDigit()->willReturn('check');
        $decorated->get16()->willReturn('16');

        $account = new BankAccount('bank', $decorated->reveal());

        $this->assertSame('bank', $account->getBankName());
        $this->assertSame('raw', $account->getRawNumber());
        $this->assertSame('formatted', $account->getNumber());
        $this->assertSame('clear', $account->getClearingNumber());
        $this->assertSame('clearCheck', $account->getClearingCheckDigit());
        $this->assertSame('serial', $account->getSerialNumber());
        $this->assertSame('check', $account->getCheckDigit());
        $this->assertSame('16', $account->get16());
    }

    public function testEqualsFailIfDifferentBank()
    {
        $decorated = $this->prophesize(AccountNumber::CLASS);

        $decorated->equals(Argument::any(), false)->willReturn(true);
        $decorated->getBankName()->willReturn('');

        $decorated = $decorated->reveal();

        $this->assertFalse(
            (new BankAccount('bar', $decorated))->equals($decorated),
            'Accounts should not be equal as the bank name differ'
        );
    }
}
