<?php

declare(strict_types=1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;

/**
 * Validate that there is no clearing number check digit
 */
class NoClearingCheckDigitValidator implements ValidatorInterface
{
    public function validate(AccountNumber $number): ResultInterface
    {
        if ($number->getClearingCheckDigit() != '') {
            return new Failure("Unexpected clearing number check digit");
        }

        return new Success("No clearing check digit");
    }
}
