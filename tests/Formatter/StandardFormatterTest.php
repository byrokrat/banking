<?php

declare(strict_types = 1);

namespace byrokrat\banking\Formatter;

use byrokrat\banking\AccountNumber;

class StandardFormatterTest extends \PHPUnit\Framework\TestCase
{
    use \Prophecy\PhpUnit\ProphecyTrait;

    public function testFormat()
    {
        $number = $this->prophesize(AccountNumber::CLASS);

        $number->getClearingNumber()->willReturn('1111');
        $number->getClearingCheckDigit()->willReturn('');
        $number->getSerialNumber()->willReturn('33333333');
        $number->getCheckDigit()->willReturn('4');

        $this->assertSame(
            '1111,33333333-4',
            (new StandardFormatter)->format($number->reveal())
        );
    }

    public function testFormatClearingCheckDigit()
    {
        $number = $this->prophesize(AccountNumber::CLASS);

        $number->getClearingNumber()->willReturn('1111');
        $number->getClearingCheckDigit()->willReturn('2');
        $number->getSerialNumber()->willReturn('33333333');
        $number->getCheckDigit()->willReturn('4');

        $this->assertSame(
            '1111-2,33333333-4',
            (new StandardFormatter)->format($number->reveal())
        );
    }
}
