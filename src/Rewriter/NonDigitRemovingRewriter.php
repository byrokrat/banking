<?php

namespace byrokrat\banking\Rewriter;

/**
 * Remove all characters that are not digits from account number
 */
class NonDigitRemovingRewriter implements RewriterStrategy
{
    public function rewrite($number)
    {
        return preg_replace('/[^0-9,]/', '', $number);
    }
}
