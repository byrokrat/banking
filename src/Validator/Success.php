<?php

declare(strict_types=1);

namespace byrokrat\banking\Validator;

/**
 * A successful validation attempt
 */
class Success implements ResultInterface
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
        return true;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
