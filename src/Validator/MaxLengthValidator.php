<?php

namespace byrokrat\banking\Validator;

use byrokrat\banking\Validator;
use byrokrat\banking\AccountNumber;
use byrokrat\banking\Exception\InvalidStructureException;

/**
 * Validate length of the raw number
 */
class MaxLengthValidator implements Validator
{
    /**
     * @var integer Max length
     */
    private $maxLength;

    /**
     * Set max length
     *
     * @param integer $maxLength
     */
    public function __construct($maxLength)
    {
        $this->maxLength = $maxLength;
    }

    /**
     * Validate length of the raw number
     *
     * Delimiters and spaces are ignored.
     *
     * @param  AccountNumber $number
     * @return null
     * @throws InvalidStructureException If length is invalid
     */
    public function validate(AccountNumber $number)
    {
        $len = strlen(str_replace([' ', ',', '-'], '', $number->getRawNumber()));
        $len -= strlen($number->getClearingCheckDigit());
        if ($len > $this->maxLength) {
            throw new InvalidStructureException(
                "Invalid raw length for {$number->getRawNumber()}, expected: " . $this->maxLength
            );
        }
    }
}
