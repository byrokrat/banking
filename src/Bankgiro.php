<?php

declare(strict_types = 1);

namespace byrokrat\banking;

use byrokrat\banking\Formatter\BankgiroFormatter;

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
        return $this->format(new BankgiroFormatter);
    }

    public function prettyprint(): string
    {
        return $this->format(new BankgiroFormatter);
    }
}
