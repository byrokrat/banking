<?php

declare(strict_types = 1);

namespace byrokrat\banking\Rewriter;

use byrokrat\banking\AccountNumber;

class ChainingRewriterTest extends \PHPUnit\Framework\TestCase
{
    use \Prophecy\PhpUnit\ProphecyTrait;

    public function testRewrite()
    {
        $number = $this->prophesize(AccountNumber::CLASS)->reveal();

        $rewriter1 = $this->prophesize(RewriterInterface::CLASS);
        $rewriter1->rewrite($number)->willReturn($number)->shouldBeCalled();

        $rewriter2 = $this->prophesize(RewriterInterface::CLASS);
        $rewriter2->rewrite($number)->willReturn($number)->shouldBeCalled();

        $this->assertSame(
            $number,
            (new ChainingRewriter($rewriter1->reveal(), $rewriter2->reveal()))->rewrite($number)
        );
    }
}
