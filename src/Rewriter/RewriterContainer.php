<?php

declare(strict_types=1);

namespace byrokrat\banking\Rewriter;

/**
 * Container of rewriters
 *
 * @implements \IteratorAggregate<RewriterInterface>
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
     *
     * @return \Traversable & iterable<RewriterInterface>
     */
    public function getIterator(): \Traversable
    {
        foreach (Permutator::getPermutations($this->rewriters) as $permutation) {
            yield new ChainingRewriter(...$permutation);
        }
    }
}
