<?php

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;
use byrokrat\id\PersonalId;
use byrokrat\banking\Exception\InvalidCheckDigitException;
use byrokrat\banking\Exception\InvalidAccountNumberException;

/**
 * Validate personal ids
 */
class PersonalIdValidator implements Validator
{
    /**
     * Validate that number is a swedish personal id
     *
     * @param  AccountNumber $number
     * @return null
     * @throws InvalidCheckDigitException    If checkdigit is not valid
     * @throws InvalidAccountNumberException If number is not a valid personal id
     */
    public function validate(AccountNumber $number)
    {
        try {
            new PersonalId($number->getSerialNumber() . $number->getCheckDigit());
        } catch (\byrokrat\id\Exception\InvalidCheckDigitException $e) {
            throw new InvalidCheckDigitException("Invalid check digit {$number->getCheckDigit()} in $number", 0, $e);
        } catch (\byrokrat\id\Exception\RuntimeException $e) {
            throw new InvalidAccountNumberException("Account number $number is not a valid personal id number", 0, $e);
        }
    }
}
