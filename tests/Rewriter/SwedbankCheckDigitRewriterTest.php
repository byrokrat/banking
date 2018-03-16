<?php

namespace byrokrat\banking\Rewriter;

class SwedbankCheckDigitRewriterTest extends \PHPUnit\Framework\TestCase
{
    public function testRewrite()
    {
        $this->assertSame(
            '1234-5,123456-7',
            (new SwedbankCheckDigitRewriter)->rewrite('1234,5123456-7')
        );
    }
}
