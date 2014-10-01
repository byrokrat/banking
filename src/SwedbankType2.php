<?php
/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace ledgr\banking;

use ledgr\checkdigit\Modulo10;

/**
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class SwedbankType2 implements AccountNumber
{
    use Component\Constructor;

    /**
     * Get name of Bank this number belongs to (implements AccountNumber)
     */
    public function getBankName()
    {
        return self::BANK_SWEDBANK;
    }

    protected function getStructure()
    {
        return "/^(\d{4}),?0{0,2}(\d{1,9})(\d)$/";
    }

    protected function isValidClearing()
    {
        return $this->getClearingNumber() >= 8000 && $this->getClearingNumber() <= 8999;
    }

    protected function isValidCheckDigit()
    {
        return Modulo10::verify(
            $this->getSerialNumber() . $this->getCheckDigit()
        );
    }
}
