<?php

namespace byrokrat\banking\Rewriter;

/**
 * Replace and unvalid clearing-serial separating dash with a comma
 */
class ClearingSeparatorRewriter implements RewriterStrategy
{
    public function rewrite($number)
    {
        return preg_replace(
            '/-/',
            ',',
            $number,
            1
        );
    }
}
