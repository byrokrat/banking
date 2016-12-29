<?php

namespace byrokrat\banking\Rewriter;

/**
 * Replace and unvalid clearing-serial separating dash with a comma
 *
 * @codeCoverageIgnore
 * @deprecated
 */
class ClearingSeparatorRewriter implements RewriterStrategy
{
    public function __construct()
    {
        trigger_error("ClearingSeparatorRewriter is deprecated and will be removed", E_USER_DEPRECATED);
    }

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
