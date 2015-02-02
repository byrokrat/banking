<?php

namespace byrokrat\banking;

/**
 * Account number validator interface
 */
interface Validator
{
    /**
     * Validate number (throw exception if invalid)
     *
     * @param  AccountNumber $number
     * @throws Exception\InvalidAccountNumberException If $number is not valid
     */
    public function validate(AccountNumber $number);
}
