<?php

namespace byrokrat\banking\Rewriter;

/**
 * Create standard sets of preprocessors and rewrites
 */
class RewriterFactory
{
    public function createPreprocessors()
    {
        return [
            new NonDigitRemovingRewriter,
            new LeftTrimRewriter
        ];
    }

    public function createRewrites()
    {
        return [
            new SwedbankCheckDigitRewriter
        ];
    }
}
