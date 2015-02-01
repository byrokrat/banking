<?php

namespace byrokrat\banking\Component;

use byrokrat\banking\Exception\InvalidClearingNumberException;
use byrokrat\banking\Exception\InvalidStructureException;
use byrokrat\banking\Exception\InvalidCheckDigitException;

/**
 * @todo Kan raderas när inga referenser finns längre
 */
trait Constructor
{
    use BaseImplementation;

    /**
     * Parse account number using structural regular expression
     *
     * @param  string $number
     * @throws InvalidStructureException      If structure is invalid
     * @throws InvalidClearingNumberException If clearing number is invalid
     * @throws InvalidCheckDigitException     If check digit is invalid
     */
    public function __construct($number)
    {
        if (!preg_match($this->getStructure(), $number, $matches)) {
            throw new InvalidStructureException("Invalid structre in <$number>");
        }

        $this->setup(array_slice($matches, 1));

        if (!$this->isValidClearing()) {
            throw new InvalidClearingNumberException("Invalid clearing number in <$number>");
        }

        if (!$this->isValidCheckDigit()) {
            throw new InvalidCheckDigitException("Invalid check digit in <$number>");
        }
    }

    /**
     * Get regular expression describing account structure
     *
     * @return string
     */
    abstract protected function getStructure();

    /**
     * Load data returned by parsing regular expression
     *
     * Default implementation expects regular expression to capture three strings:
     * clearing number, serial number and check digit.
     *
     * @param  array $matches
     * @return void
     */
    protected function setup(array $matches)
    {
        list($this->clearing, $this->serial, $this->checkDigit) = $matches;
    }

    /**
     * Validate clearing number
     *
     * @return boolean
     */
    protected function isValidClearing()
    {
        return true;
    }

    /**
     * Validate account number check digit
     *
     * @return boolean
     */
    protected function isValidCheckDigit()
    {
        return true;
    }
}
