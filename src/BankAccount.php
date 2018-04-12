<?php

declare(strict_types = 1);

namespace byrokrat\banking;

/**
 * Account number decorator for accounts belonging to a bank
 */
class BankAccount implements AccountNumber
{
    /**
     * @var string The name of the Bank this number belongs to
     */
    private $bankName;

    /**
     * @var AccountNumber
     */
    private $decorated;

    public function __construct(string $bankName, AccountNumber $decorated)
    {
        $this->bankName = $bankName;
        $this->decorated = $decorated;
    }

    public function getBankName(): string
    {
        return $this->bankName;
    }

    public function getNumber(): string
    {
        return $this->decorated->getNumber();
    }

    public function __toString(): string
    {
        return $this->decorated->__toString();
    }

    public function getClearingNumber(): string
    {
        return $this->decorated->getClearingNumber();
    }

    public function getClearingCheckDigit(): string
    {
        return $this->decorated->getClearingCheckDigit();
    }

    public function getSerialNumber(): string
    {
        return $this->decorated->getSerialNumber();
    }

    public function getCheckDigit(): string
    {
        return $this->decorated->getCheckDigit();
    }

    public function get16(): string
    {
        return $this->decorated->get16();
    }

    public function equals(AccountNumber $account, bool $strict = false): bool
    {
        return $this->decorated->equals($account, $strict) && $this->getBankName() == $account->getBankName();
    }
}
