<?php

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;
use byrokrat\banking\Exception\InvalidAccountNumberException;

/**
 * Account number validator interface
 */
interface Validator
{
    /**
     * Validate number (throw exception if invalid)
     *
     * @param  AccountNumber $number
     * @throws InvalidAccountNumberException If $number is not valid
     */
    public function validate(AccountNumber $number);
}
