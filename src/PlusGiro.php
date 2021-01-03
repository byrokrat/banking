<?php

declare(strict_types=1);

namespace byrokrat\banking;

use byrokrat\banking\Formatter\PlusgiroFormatter;

class PlusGiro extends UndefinedAccount
{
    public function __construct(string $raw, string $serial, string $check)
    {
        parent::__construct($raw, '0000', '', $serial, $check);
    }

    public function getBankName(): string
    {
        return BankNames::BANK_PLUSGIRO;
    }

    public function getNumber(): string
    {
        return $this->format(new PlusgiroFormatter());
    }

    public function prettyprint(): string
    {
        return $this->format(new PlusgiroFormatter());
    }
}
