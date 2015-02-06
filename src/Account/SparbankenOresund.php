<?php

namespace byrokrat\banking\Account;

/**
 * Sparbanken Öresund account
 */
class SparbankenOresund extends BaseAccount
{
    public function getBankName()
    {
        return BankNames::BANK_SPARBANKEN_ORESUND;
    }
}
