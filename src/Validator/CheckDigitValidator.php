<?php

declare(strict_types = 1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;

/**
 * Validate check digits
 */
abstract class CheckDigitValidator implements ValidatorInterface
{
    public function validate(AccountNumber $number): ResultInterface
    {
        if ($number->getCheckDigit() === '' || $number->getSerialNumber() === '') {
            return new Failure('Unable to validate checkdigit, not enough digits');
        }

        $expected = $this->calculateCheckDigit($number);

        if ($number->getCheckDigit() == $expected) {
            return new Success("Valid check digit $expected");
        }

        return new Failure("Invalid check digit {$number->getCheckDigit()}, expected $expected");
    }

    /**
     * Calculate the expected checkdigit
     */
    abstract protected function calculateCheckDigit(AccountNumber $number): string;
}
