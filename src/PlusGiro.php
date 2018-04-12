<?php

declare(strict_types = 1);

namespace byrokrat\banking;

/**
 * PlusGiro account number
 */
class PlusGiro extends UndefinedAccount
{
    public function __construct(string $serial, string $check)
    {
        parent::__construct('0000', '', $serial, $check);
    }

    public function getBankName(): string
    {
        return BankNames::BANK_PLUSGIRO;
    }

    public function getNumber(): string
    {
        return sprintf(
            '%s-%s',
            $this->getSerialNumber(),
            $this->getCheckDigit()
        );
    }
}
