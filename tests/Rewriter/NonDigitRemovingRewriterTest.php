<?php

namespace byrokrat\banking\Rewriter;

class NonDigitRemovingRewriterTest extends \PHPUnit_Framework_TestCase
{
    public function testRewrite()
    {
        $this->assertSame(
            '0987,654321',
            (new NonDigitRemovingRewriter)->rewrite('0987,654321')
        );

        $this->assertSame(
            '12',
            (new NonDigitRemovingRewriter)->rewrite('jsd1&/J2H*-')
        );

        $this->assertSame(
            '12',
            (new NonDigitRemovingRewriter)->rewrite('  1  2  ')
        );

        $this->assertSame(
            '12',
            (new NonDigitRemovingRewriter)->rewrite("  1\t2  ")
        );

        $this->assertSame(
            '12',
            (new NonDigitRemovingRewriter)->rewrite("\n1\n2\n\r\n")
        );
    }
}
