<?php

declare(strict_types=1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;

/**
 * Validate length of serial number
 */
class SerialLengthValidator implements ValidatorInterface
{
    /**
     * @var integer
     */
    private $min;

    /**
     * @var integer
     */
    private $max;

    public function __construct(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function validate(AccountNumber $number): ResultInterface
    {
        $len = strlen($number->getSerialNumber());

        if ($len < $this->min) {
            return new Failure(
                "Invalid serial length $len, must be at least {$this->min}"
            );
        }

        if ($len > $this->max) {
            return new Failure(
                "Invalid serial length $len, must not be longer than {$this->max}"
            );
        }

        return new Success("Valid serial length $len");
    }
}
