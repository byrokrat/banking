<?php

declare(strict_types = 1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;
use byrokrat\id\PersonalId;

/**
 * Validate that account numbers are valid swedish personal ids
 */
class PersonalIdValidator implements ValidatorInterface
{
    public function validate(AccountNumber $number): ResultInterface
    {
        try {
            new PersonalId($number->getSerialNumber() . $number->getCheckDigit());
            return new Success("Valid personal id number");
        } catch (\byrokrat\id\Exception\InvalidCheckDigitException $e) {
            return new Failure("Invalid check digit {$number->getCheckDigit()}");
        } catch (\byrokrat\id\Exception\RuntimeException $e) {
            return new Failure("Account number is not a valid personal id number");
        }
    }
}
