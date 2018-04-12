<?php

declare(strict_types = 1);

namespace byrokrat\banking;

use byrokrat\banking\Exception\InvalidAccountNumberException;
use byrokrat\banking\Validator\CheckDigitType2Validator;
use byrokrat\banking\Validator\ValidatorInterface;

/**
 * Plusgiro account number factory
 */
class PlusgiroFactory implements AccountFactoryInterface
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct()
    {
        $this->validator = new CheckDigitType2Validator;
    }

    public function createAccount(string $number): AccountNumber
    {
        if (!preg_match('/^(\d{1,7})-?(\d)$/', $number, $matches)) {
            throw new InvalidAccountNumberException("Invalid PlusGiro account number structure");
        }

        $account = new PlusGiro($matches[1], $matches[2]);

        $result = $this->validator->validate($account);

        if (!$result->isValid()) {
            throw new InvalidAccountNumberException(
                "Unable to parse PlusGiro $number: {$result->getMessage()}"
            );
        }

        return $account;
    }
}
