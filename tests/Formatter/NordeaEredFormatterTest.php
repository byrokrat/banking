<?php

declare(strict_types=1);

namespace byrokrat\banking\Formatter;

use byrokrat\banking\AccountNumber;

class NordeaEredFormatterTest extends \PHPUnit\Framework\TestCase
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
            '1111333333334',
            (new NordeaEredFormatter())->format($number->reveal())
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
            '11112333333334',
            (new NordeaEredFormatter())->format($number->reveal())
        );
    }

    public function testFormatPersonalAccountNumbers()
    {
        $number = $this->prophesize(AccountNumber::CLASS);

        $number->getClearingNumber()->willReturn('3300');
        $number->getClearingCheckDigit()->willReturn('');
        $number->getSerialNumber()->willReturn('111111111');
        $number->getCheckDigit()->willReturn('6');

        $this->assertSame(
            '1111111116',
            (new NordeaEredFormatter())->format($number->reveal())
        );
    }
}
