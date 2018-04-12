<?php

declare(strict_types = 1);

namespace byrokrat\banking\Rewriter;

/**
 * Create the default set of rewriters
 */
class RewriterFactory
{
    const MINIMAL_SERIAL_REWRITE_LENGTH = 6;

    public function createRewriters(): RewriterContainer
    {
        return new RewriterContainer(
            new ClearingCheckDigitRewriter,
            new SerialTrimRewriter(self::MINIMAL_SERIAL_REWRITE_LENGTH),
            new ClearingPrependingRewriter('3300')
        );
    }
}
