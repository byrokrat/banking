<?php

namespace byrokrat\banking\Rewriter;

use byrokrat\banking\AccountNumber;

/**
 * Strategy interface for rewriting account numbers
 */
interface RewriterInterface
{
    /**
     * Rewrite number according to strategy
     */
    public function rewrite(AccountNumber $account): AccountNumber;
}
