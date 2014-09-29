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
class NordeaType1B implements AccountNumber
{
    use Component\Type1B;

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
        return $this->getClearing() >= 4000 &&  $this->getClearing() <= 4999;
    }
}
