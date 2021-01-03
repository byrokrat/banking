<?php

declare(strict_types=1);

namespace byrokrat\banking\Formatter;

use byrokrat\banking\AccountNumber;

class BankgiroFormatterTest extends \PHPUnit\Framework\TestCase
{
    use \Prophecy\PhpUnit\ProphecyTrait;

    public function testFormatShort()
    {
        $number = $this->prophesize(AccountNumber::CLASS);

        $number->getSerialNumber()->willReturn('123456');
        $number->getCheckDigit()->willReturn('7');

        $this->assertSame(
            '123-4567',
            (new BankgiroFormatter())->format($number->reveal())
        );
    }

    public function testFormatLong()
    {
        $number = $this->prophesize(AccountNumber::CLASS);

        $number->getSerialNumber()->willReturn('1234567');
        $number->getCheckDigit()->willReturn('8');

        $this->assertSame(
            '1234-5678',
            (new BankgiroFormatter())->format($number->reveal())
        );
    }
}
