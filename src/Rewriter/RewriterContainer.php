<?php

declare(strict_types = 1);

namespace byrokrat\banking\Rewriter;

use drupol\phpermutations\Generators\Permutations;

/**
 * Container of rewriters
 */
class RewriterContainer implements \IteratorAggregate
{
    /**
     * @var RewriterInterface[]
     */
    private $rewriters;

    public function __construct(RewriterInterface ...$rewriters)
    {
        $this->rewriters = $rewriters;
    }

    /**
     * Generates all possible permutations of all possible lenghts of the rewriter set
     */
    public function getIterator(): \Traversable
    {
        foreach (range(1, count($this->rewriters)) as $length) {
            foreach ((new Permutations($this->rewriters, $length))->generator() as $permutation) {
                yield new ChainingRewriter(...$permutation);
            }
        }
    }
}
