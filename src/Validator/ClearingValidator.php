<?php

declare(strict_types = 1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;

/**
 * Validate clearing numbers
 */
class ClearingValidator implements ValidatorInterface
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
     */
    public function validate(AccountNumber $number): ResultInterface
    {
        $clearing = intval($number->getClearingNumber());

        foreach ($this->clearingRanges as $clearingRange) {
            if ($clearing >= $clearingRange[0] && $clearing <= $clearingRange[1]) {
                return new Success(
                    "Clearing number $clearing is within range {$clearingRange[0]} to {$clearingRange[1]}"
                );
            }
        }

        return new Failure(
            "Clearing number $clearing not within range {$clearingRange[0]} to {$clearingRange[1]}"
        );
    }
}
