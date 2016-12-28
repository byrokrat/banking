<?php

namespace byrokrat\banking;

/**
 * @deprecated Use FormatFactory instead
 * @codeCoverageIgnore
 */
class Formats extends FormatFactory
{
    public function __construct()
    {
        trigger_error("Use of the Formats class is deprecated, use FormatFactory instead", E_USER_DEPRECATED);
    }
}
