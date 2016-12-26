<?php

namespace byrokrat\banking\Rewriter;

/**
 * Rewrite missplaced swedbank clearing number check digit
 */
class SwedbankCheckDigitRewriter implements RewriterStrategy
{
    public function rewrite($number)
    {
        return preg_replace(
            '/^(\d{4}),?(\d)(.+)$/',
            '$1-$2,$3',
            $number
        );
    }
}
