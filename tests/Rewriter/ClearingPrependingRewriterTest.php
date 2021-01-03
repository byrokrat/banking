<?php

declare(strict_types=1);

namespace byrokrat\banking\Rewriter;

use byrokrat\banking\AccountNumber;

class ClearingPrependingRewriterTest extends \PHPUnit\Framework\TestCase
{
    use \Prophecy\PhpUnit\ProphecyTrait;

    public function testRewrite()
    {
        $number = $this->prophesize(AccountNumber::CLASS);

        $number->getRawNumber()->willReturn('raw');
        $number->getClearingNumber()->willReturn('2');
        $number->getClearingCheckDigit()->willReturn('3');
        $number->getSerialNumber()->willReturn('4');
        $number->getCheckDigit()->willReturn('5');

        $this->assertSame(
            '1,234-5',
            (new ClearingPrependingRewriter('1'))->rewrite($number->reveal())->getNumber()
        );
    }
}
