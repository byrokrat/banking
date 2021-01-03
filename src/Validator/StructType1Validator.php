<?php

declare(strict_types=1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;

/**
 * Validate serial number length according to type 1
 */
class StructType1Validator extends SerialLengthValidator
{
    public function __construct()
    {
        parent::__construct(6, 6);
    }
}
