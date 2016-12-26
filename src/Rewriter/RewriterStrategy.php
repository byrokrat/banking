<?php

namespace byrokrat\banking\Rewriter;

/**
 * Strategy interface for rewriting account numbers
 */
interface RewriterStrategy
{
    /**
     * Rewrite number according to strategy
     *
     * @param  string $number
     * @return string
     */
    public function rewrite($number);
}
