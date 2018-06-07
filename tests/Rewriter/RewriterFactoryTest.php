<?php

declare(strict_types = 1);

namespace byrokrat\banking\Rewriter;

class RewriterFactoryTest extends \PHPUnit\Framework\TestCase
{
    public function testCreateRewriters()
    {
        $this->assertInstanceOf(
            RewriterContainer::CLASS,
            (new RewriterFactory)->createRewriters()
        );
    }
}
