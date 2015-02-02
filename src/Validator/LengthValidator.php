<?php

namespace byrokrat\banking\Validator;

use byrokrat\banking\Validator;
use byrokrat\banking\AccountNumber;
use byrokrat\banking\Exception\InvalidAccountNumberException;

/**
 * Validate length of the raw number
 */
class LengthValidator implements Validator
{
    /**
     * @var integer Expected length
     */
    private $length;

    /**
     * Set expected length
     *
     * @param integer $length
     */
    public function __construct($length)
    {
        $this->length = $length;
    }

    /**
     * Validate length of the raw number
     *
     * Delimiters and spaces are ignored.
     *
     * @param  AccountNumber $number
     * @return null
     * @throws InvalidAccountNumberException If length is invalid
     */
    public function validate(AccountNumber $number)
    {
        if (strlen(str_replace([' ', ',', '-'], '', $number->getRawNumber())) != $this->length) {
            throw new InvalidAccountNumberException(
                "Invalid raw length for $number, expected: " . $this->length
            );
        }
    }
}
