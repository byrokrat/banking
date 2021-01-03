<?php

declare(strict_types=1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;

/**
 * Validate serial number length according to type 2
 */
class StructType2Validator extends SerialLengthValidator
{
    public function __construct()
    {
        parent::__construct(1, 9);
    }
}
