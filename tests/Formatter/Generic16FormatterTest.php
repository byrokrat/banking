<?php

declare(strict_types=1);

namespace byrokrat\banking\Formatter;

use byrokrat\banking\AccountNumber;

class Generic16FormatterTest extends \PHPUnit\Framework\TestCase
{
    use \Prophecy\PhpUnit\ProphecyTrait;

    public function testFormat()
    {
        $number = $this->prophesize(AccountNumber::CLASS);

        $number->getClearingNumber()->willReturn('1111');
        $number->getClearingCheckDigit()->willReturn('2');
        $number->getSerialNumber()->willReturn('33333333');
        $number->getCheckDigit()->willReturn('4');

        $this->assertSame(
            '1111000333333334',
            (new Generic16Formatter())->format($number->reveal())
        );
    }
}
