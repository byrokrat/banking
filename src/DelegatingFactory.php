<?php

declare(strict_types = 1);

namespace byrokrat\banking;

use byrokrat\banking\Exception\InvalidAccountNumberException;

/**
 * Factory that delegates to other factories
 */
class DelegatingFactory implements AccountFactoryInterface
{
    /**
     * @var AccountFactoryInterface[]
     */
    private $factories;

    public function __construct(AccountFactoryInterface ...$factories)
    {
        $this->factories = $factories;
    }

    public function createAccount(string $number): AccountNumber
    {
        $errors = [];

        foreach ($this->factories as $factory) {
            try {
                return $factory->createAccount($number);
            } catch (Exception $e) {
                $errors[] = $e->getMessage();
            }
        }

        throw new InvalidAccountNumberException(
            "Unable to create account for the following resons:\n" . implode("\n", $errors)
        );
    }
}
