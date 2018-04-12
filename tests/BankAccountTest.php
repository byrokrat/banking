<?php

declare(strict_types = 1);

namespace byrokrat\banking;

class BankAccountTest extends \PHPUnit\Framework\TestCase
{
    public function testSimpleGetters()
    {
        $account = new BankAccount('bank', new UndefinedAccount('clear', 'clearCheck', 'serial', 'check'));

        $this->assertSame(
            'bank',
            $account->getBankName()
        );

        $this->assertSame(
            'clear',
            $account->getClearingNumber()
        );

        $this->assertSame(
            'clearCheck',
            $account->getClearingCheckDigit()
        );

        $this->assertSame(
            'serial',
            $account->getSerialNumber()
        );

        $this->assertSame(
            'check',
            $account->getCheckDigit()
        );
    }

    public function testGetNumber()
    {
        $decorated = $this->prophesize(AccountNumber::CLASS);
        $decorated->getNumber()->willReturn('foobar');

        $this->assertSame(
            'foobar',
            (new BankAccount('', $decorated->reveal()))->getNumber()
        );
    }

    public function testGet16()
    {
        $decorated = $this->prophesize(AccountNumber::CLASS);
        $decorated->get16()->willReturn('foobar');

        $this->assertSame(
            'foobar',
            (new BankAccount('', $decorated->reveal()))->get16()
        );
    }

    public function testEquals()
    {
        $decorated = new UndefinedAccount('', '', '', '');
        $this->assertFalse(
            (new BankAccount('bar', $decorated))->equals($decorated),
            'Accounts should not be equal as the bank name differ'
        );
    }
}
