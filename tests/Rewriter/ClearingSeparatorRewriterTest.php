<?php

namespace byrokrat\banking\Rewriter;

class ClearingSeparatorRewriterTest extends \PHPUnit_Framework_TestCase
{
    public function testRewrite()
    {
        $this->assertSame(
            '1234,123456-7',
            (new ClearingSeparatorRewriter)->rewrite('1234-123456-7')
        );
    }
}
