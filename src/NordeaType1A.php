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
     * Get string describing account type (implements AccountNumber)
     *
     * @return string
     */
    public function getType()
    {
        return "Nordea";
    }

    /**
     * Validate clearing number (from Component\Constructor)
     *
     * @return boolean
     */
    protected function isValidClearing()
    {
        return (
            ($this->getClearing() >= 1100 && $this->getClearing() <= 1199)
            || ($this->getClearing() >= 1400 && $this->getClearing() <= 2099)
            || ($this->getClearing() >= 3000 && $this->getClearing() <= 3399 && $this->getClearing() != 3300)
            || ($this->getClearing() >= 3410 && $this->getClearing() <= 3999 && $this->getClearing() != 3782)
        );
    }
}
