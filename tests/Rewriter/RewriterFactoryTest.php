<?php

namespace byrokrat\banking\Rewriter;

class RewriterFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateRewrites()
    {
        foreach ((new RewriterFactory)->createRewrites() as $rewrite) {
            $this->assertInstanceOf(
                'byrokrat\banking\Rewriter\RewriterStrategy',
                $rewrite
            );
        }
    }
}
