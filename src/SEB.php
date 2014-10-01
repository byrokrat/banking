<?php
/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace ledgr\banking;

/**
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class SEB implements AccountNumber
{
    use Component\Type1A;

    /**
     * Get name of Bank this number belongs to (implements AccountNumber)
     */
    public function getBankName()
    {
        return self::BANK_SEB;
    }

    protected function isValidClearing()
    {
        return (
            ( $this->getClearingNumber() >= 5000 && $this->getClearingNumber() <= 5999 )
            || ( $this->getClearingNumber() >= 9120 && $this->getClearingNumber() <= 9124 )
            || ( $this->getClearingNumber() >= 9130 && $this->getClearingNumber() <= 9149 )
        );
    }
}
