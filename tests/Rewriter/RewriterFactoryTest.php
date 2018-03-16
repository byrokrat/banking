<?php

namespace byrokrat\banking\Rewriter;

class RewriterFactoryTest extends \PHPUnit\Framework\TestCase
{
    public function testCreatePreprocessors()
    {
        foreach ((new RewriterFactory)->createPreprocessors() as $preprocessor) {
            $this->assertInstanceOf(
                'byrokrat\banking\Rewriter\RewriterStrategy',
                $preprocessor
            );
        }
    }

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
