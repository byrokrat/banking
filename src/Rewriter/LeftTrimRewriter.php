<?php

namespace byrokrat\banking\Rewriter;

/**
 * Trim ceros from account left side
 */
class LeftTrimRewriter implements RewriterStrategy
{
    public function rewrite($number)
    {
        return ltrim($number, '0');
    }
}
