<?php

declare(strict_types = 1);

namespace byrokrat\banking\Rewriter;

use byrokrat\banking\AccountNumber;

class SerialTrimRewriterTest extends \PHPUnit\Framework\TestCase
{
    public function testRewrite()
    {
        $number = $this->prophesize(AccountNumber::CLASS);

        $number->getRawNumber()->willReturn('raw');
        $number->getClearingNumber()->willReturn('1');
        $number->getClearingCheckDigit()->willReturn('2');
        $number->getSerialNumber()->willReturn('0003');
        $number->getCheckDigit()->willReturn('4');

        $this->assertSame(
            '1-2,3-4',
            (new SerialTrimRewriter)->rewrite($number->reveal())->getNumber()
        );
    }

    public function testMinimalLength()
    {
        $number = $this->prophesize(AccountNumber::CLASS);

        $number->getRawNumber()->willReturn('raw');
        $number->getClearingNumber()->willReturn('');
        $number->getClearingCheckDigit()->willReturn('');
        $number->getSerialNumber()->willReturn('0012345');
        $number->getCheckDigit()->willReturn('');

        $this->assertSame(
            '012345',
            (new SerialTrimRewriter(6))->rewrite($number->reveal())->getSerialNumber(),
            'Only one cero should be trimmed as minimal length is set to 6'
        );
    }

    public function testNoRewriteOfToShortNumber()
    {
        $number = $this->prophesize(AccountNumber::CLASS);

        $number->getRawNumber()->willReturn('raw');
        $number->getClearingNumber()->willReturn('');
        $number->getClearingCheckDigit()->willReturn('');
        $number->getSerialNumber()->willReturn('003');
        $number->getCheckDigit()->willReturn('');

        $this->assertSame(
            '003',
            (new SerialTrimRewriter(6))->rewrite($number->reveal())->getSerialNumber(),
            'No ceros should be trimmed as minimal length is set to 6'
        );
    }
}
