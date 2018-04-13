<?php

declare(strict_types = 1);

namespace byrokrat\banking;

/**
 * Bankgiro account number
 */
class Bankgiro extends UndefinedAccount
{
    public function __construct(string $raw, string $serial, string $check)
    {
        parent::__construct($raw, '0000', '', $serial, $check);
    }

    public function getBankName(): string
    {
        return BankNames::BANK_BANKGIRO;
    }

    public function getNumber(): string
    {
        return sprintf(
            '%s-%s%s',
            substr($this->getSerialNumber(), 0, -3),
            substr($this->getSerialNumber(), -3),
            $this->getCheckDigit()
        );
    }
}
