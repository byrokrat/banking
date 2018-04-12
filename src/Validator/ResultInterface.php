<?php

namespace byrokrat\banking\Validator;

/**
 * The outcome of a validation attempt
 */
interface ResultInterface
{
    /**
     * Check if validation was a success
     */
    public function isValid(): bool;

    /**
     * Get free text message describing validation outcome
     */
    public function getMessage(): string;
}
