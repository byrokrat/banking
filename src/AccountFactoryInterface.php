<?php

namespace byrokrat\banking;

/**
 * Interface for account number factories
 */
interface AccountFactoryInterface
{
    /**
     * Create bank account object using number
     */
    public function createAccount(string $number): AccountNumber;
}
