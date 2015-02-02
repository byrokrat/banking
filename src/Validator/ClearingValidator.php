<?php

namespace byrokrat\banking\Validator;

use byrokrat\banking\Validator;
use byrokrat\banking\AccountNumber;
use byrokrat\banking\Exception\InvalidClearingNumberException;

/**
 * Validate clearing number
 */
class ClearingValidator implements Validator
{
    /**
     * @var array List of clearing number max and min values
     */
    private $clearingRanges;

    /**
     * Load ranges of valid clearing numbers
     *
     * @param array $clearingRanges
     */
    public function __construct(array $clearingRanges)
    {
        $this->clearingRanges = $clearingRanges;
    }

    /**
     * Validate clearing number
     *
     * Clearing must be in one of the specified ranges to be considered valid.
     *
     * @param  AccountNumber $number
     * @return null
     * @throws InvalidClearingNumberException If clearing number is not valid
     */
    public function validate(AccountNumber $number)
    {
        $clearing = (int)$number->getClearingNumber();

        foreach ($this->clearingRanges as $clearingRange) {
            if ($clearing >= $clearingRange[0] && $clearing <= $clearingRange[1]) {
                return;
            }
        }

        throw new InvalidClearingNumberException("Invalid clearing number in $number");
    }
}
