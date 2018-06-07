<?php

namespace byrokrat\banking\Formatter;

use byrokrat\banking\AccountNumber;

/**
 * Format an account number
 */
interface FormatterInterface
{
    public function format(AccountNumber $number): string;
}
