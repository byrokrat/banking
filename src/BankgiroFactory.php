<?php

declare(strict_types = 1);

namespace byrokrat\banking;

use byrokrat\banking\Exception\InvalidAccountNumberException;
use byrokrat\banking\Validator\CheckDigitType2Validator;
use byrokrat\banking\Validator\ValidatorInterface;

/**
 * Bankgiro account number factory
 */
class BankgiroFactory implements AccountFactoryInterface
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
        if (!preg_match('/^0*(\d{3,4})-?(\d{3})(\d)$/', $number, $matches)) {
            throw new InvalidAccountNumberException("Invalid bankgiro account number structure");
        }

        $account = new Bankgiro($number, $matches[1].$matches[2], $matches[3]);

        $result = $this->validator->validate($account);

        if (!$result->isValid()) {
            throw new InvalidAccountNumberException(
                "Unable to parse bankgiro $number: {$result->getMessage()}"
            );
        }

        return $account;
    }
}
