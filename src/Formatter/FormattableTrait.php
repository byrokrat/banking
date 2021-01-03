<?php

namespace byrokrat\banking\Formatter;

use byrokrat\banking\AccountNumber;

/**
 * Helper trait that implements the AccountNumber formatting methods
 */
trait FormattableTrait
{
    abstract protected function getFormattable(): AccountNumber;

    public function format(FormatterInterface $formatter): string
    {
        return $formatter->format($this->getFormattable());
    }

    public function getNumber(): string
    {
        return $this->format(new StandardFormatter());
    }

    public function __toString(): string
    {
        return $this->getNumber();
    }

    public function get16(): string
    {
        return $this->format(new Generic16Formatter());
    }

    public function prettyprint(): string
    {
        return $this->format(new PrettyprintingFormatter());
    }
}
