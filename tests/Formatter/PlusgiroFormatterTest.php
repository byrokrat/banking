<?php

declare(strict_types=1);

namespace byrokrat\banking\Formatter;

use byrokrat\banking\AccountNumber;

class PlusgiroFormatterTest extends \PHPUnit\Framework\TestCase
{
    use \Prophecy\PhpUnit\ProphecyTrait;

    public function testFormat()
    {
        $number = $this->prophesize(AccountNumber::CLASS);

        $number->getSerialNumber()->willReturn('33333333');
        $number->getCheckDigit()->willReturn('4');

        $this->assertSame(
            '33333333-4',
            (new PlusgiroFormatter())->format($number->reveal())
        );
    }
}
