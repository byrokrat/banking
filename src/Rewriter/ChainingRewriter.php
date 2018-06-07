<?php

declare(strict_types = 1);

namespace byrokrat\banking\Rewriter;

use byrokrat\banking\AccountNumber;

/**
 * Rewriter that chains multiple rewriters
 */
class ChainingRewriter implements RewriterInterface
{
    /**
     * @var RewriterInterface[]
     */
    private $rewriters;

    public function __construct(RewriterInterface ...$rewriters)
    {
        $this->rewriters = $rewriters;
    }

    public function rewrite(AccountNumber $account): AccountNumber
    {
        return array_reduce(
            $this->rewriters,
            function (AccountNumber $account, RewriterInterface $rewriter): AccountNumber {
                return $rewriter->rewrite($account);
            },
            $account
        );
    }
}
