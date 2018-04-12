<?php

declare(strict_types = 1);

namespace byrokrat\banking\Validator;

/**
 * A failed validation attempt
 */
class Failure implements ResultInterface
{
    /**
     * @var string
     */
    private $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function isValid(): bool
    {
        return false;
    }

    public function getMessage(): string
    {
        return '[FAIL] ' . $this->message;
    }
}
