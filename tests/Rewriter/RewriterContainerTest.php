<?php

declare(strict_types = 1);

namespace byrokrat\banking\Rewriter;

use byrokrat\banking\AccountNumber;

class RewriterContainerTest extends \PHPUnit\Framework\TestCase
{
    public function testOneRewriter()
    {
        $rewriter = $this->prophesize(RewriterInterface::CLASS)->reveal();

        $this->assertEquals(
            [new ChainingRewriter($rewriter)],
            iterator_to_array((new RewriterContainer($rewriter))->getIterator())
        );
    }

    public function testTwoRewriters()
    {
        $A = $this->prophesize(RewriterInterface::CLASS)->reveal();
        $B = $this->prophesize(RewriterInterface::CLASS)->reveal();

        $this->assertEquals(
            [
                new ChainingRewriter($A),
                new ChainingRewriter($B),
                new ChainingRewriter($A, $B),
                new ChainingRewriter($B, $A),
            ],
            iterator_to_array((new RewriterContainer($A, $B))->getIterator())
        );
    }

    public function testThreeRewriters()
    {
        $rewriter = $this->prophesize(RewriterInterface::CLASS)->reveal();

        $this->assertCount(
            15,
            iterator_to_array((new RewriterContainer($rewriter, $rewriter, $rewriter))->getIterator())
        );
    }
}
