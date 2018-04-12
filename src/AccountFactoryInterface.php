<?php

namespace byrokrat\banking;

/**
 * Interface for account number factories
 */
interface AccountFactoryInterface
{
    /**
     * Create bank account object using number
     *
     * @throws Exception If unable to create
     */
    public function createAccount(string $number): AccountNumber;
}
