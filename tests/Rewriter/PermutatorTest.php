<?php

declare(strict_types = 1);

namespace byrokrat\banking\Rewriter;

class PermutatorTest extends \PHPUnit\Framework\TestCase
{
    public function testPermutate()
    {
        $this->assertSame(
            15,
            iterator_count(Permutator::getPermutations(['A', 'B', 'C']))
        );
    }
}
