<?php

declare(strict_types=1);

namespace byrokrat\banking\Rewriter;

use byrokrat\banking\AccountNumber;

class ClearingCheckDigitRewriterTest extends \PHPUnit\Framework\TestCase
{
    use \Prophecy\PhpUnit\ProphecyTrait;

    public function testRewrite()
    {
        $number = $this->prophesize(AccountNumber::CLASS);

        $number->getRawNumber()->willReturn('raw');
        $number->getClearingNumber()->willReturn('1');
        $number->getClearingCheckDigit()->willReturn('');
        $number->getSerialNumber()->willReturn('23');
        $number->getCheckDigit()->willReturn('4');

        $this->assertSame(
            '1-2,3-4',
            (new ClearingCheckDigitRewriter())->rewrite($number->reveal())->getNumber()
        );
    }

    public function testRewriteOfInvalidNumber()
    {
        $number = $this->prophesize(AccountNumber::CLASS);

        $number->getRawNumber()->willReturn('raw');
        $number->getClearingNumber()->willReturn('1');
        $number->getClearingCheckDigit()->willReturn('');
        $number->getSerialNumber()->willReturn('');
        $number->getCheckDigit()->willReturn('2');

        $this->assertSame(
            '1,-2',
            (new ClearingCheckDigitRewriter())->rewrite($number->reveal())->getNumber()
        );
    }
}
