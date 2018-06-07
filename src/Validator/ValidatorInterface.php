<?php

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;

/**
 * Account number validator interface
 */
interface ValidatorInterface
{
    /**
     * Validate account
     */
    public function validate(AccountNumber $number): ResultInterface;
}
