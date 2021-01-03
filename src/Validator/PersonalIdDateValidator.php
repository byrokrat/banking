<?php

declare(strict_types=1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;

/**
 * Validate that account numbers contains dates as in swedish personal ids
 */
class PersonalIdDateValidator implements ValidatorInterface
{
    public function validate(AccountNumber $number): ResultInterface
    {
        $day = (int)substr($number->getSerialNumber(), -5, 2);
        $month = (int)substr($number->getSerialNumber(), -7, 2);
        $year = (int)substr($number->getSerialNumber(), 0, -7);

        if (!checkdate($month, $day, $year)) {
            return new Failure("Account number is not a valid personal id number");
        }

        return new Success("Valid personal id number");
    }
}
