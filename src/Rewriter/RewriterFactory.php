<?php

namespace byrokrat\banking\Rewriter;

/**
 * Create standard set of rewrites
 */
class RewriterFactory
{
    public function createRewrites()
    {
        return [
            new LeftTrimRewriter,
            new ClearingSeparatorRewriter,
            new SwedbankCheckDigitRewriter
        ];
    }
}
