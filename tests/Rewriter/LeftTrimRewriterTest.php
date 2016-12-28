<?php

namespace byrokrat\banking\Rewriter;

class LeftTrimRewriterTest extends \PHPUnit_Framework_TestCase
{
    public function testRewrite()
    {
        $this->assertSame(
            '1234',
            (new LeftTrimRewriter)->rewrite('001234')
        );
    }
}
