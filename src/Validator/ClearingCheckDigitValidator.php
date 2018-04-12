<?php

declare(strict_types = 1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;

/**
 * Validate clearing number check digits
 */
class ClearingCheckDigitValidator implements ValidatorInterface
{
    /**
     * Validate clearing number check digit
     *
     * If no clearing check digit exists number is considered valid.
     */
    public function validate(AccountNumber $number): ResultInterface
    {
        $checkDigit = $number->getClearingCheckDigit();

        if ($checkDigit != '') {
            $expected = Modulo10::calculateCheckDigit($number->getClearingNumber());

            if ($expected != $checkDigit) {
                return new Failure("Invalid clearing number check digit $checkDigit, expected $expected");
            }

            return new Success("Valid clearing number check digit $checkDigit");
        }

        return new Success("Skipped validation of clearing number check digit");
    }
}
