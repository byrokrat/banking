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
class NordeaType1A implements AccountNumber
{
    use Component\Type1A;

    /**
     * Get name of Bank this number belongs to (implements AccountNumber)
     */
    public function getBankName()
    {
        return self::BANK_NORDEA;
    }

    /**
     * Validate clearing number (from Component\Constructor)
     *
     * @return boolean
     */
    protected function isValidClearing()
    {
        return (
            ($this->getClearingNumber() >= 1100 && $this->getClearingNumber() <= 1199)
            || ($this->getClearingNumber() >= 1400 && $this->getClearingNumber() <= 2099)
            || ($this->getClearingNumber() >= 3000 && $this->getClearingNumber() <= 3399 && $this->getClearingNumber() != 3300)
            || ($this->getClearingNumber() >= 3410 && $this->getClearingNumber() <= 3999 && $this->getClearingNumber() != 3782)
        );
    }
}
