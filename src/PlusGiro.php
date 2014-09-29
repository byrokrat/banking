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
 * Account number for PlusGirot (formerly PostGirot) clearing system
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class PlusGiro implements AccountNumber
{
    use Component\Giro;

    /**
     * Get string describing account type (implements AccountNumber)
     *
     * @return string
     */
    public function getType()
    {
        return "PlusGiro";
    }

    /**
     * Get account as string (implements AccountNumber)
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->getSerialNumber()
            . '-'
            . $this->getCheckDigit();
    }

    /**
     * Get regular expression describing structure (from Component\Constructor)
     *
     * @return string
     */
    protected function getStructure()
    {
        return "/^(\d{1,7})-(\d)$/";
    }

    /**
     * Load data returned by parsing regular expression (from Component\Constructor)
     *
     * @param  array $matches
     * @return void
     */
    protected function setup(array $matches)
    {
        list($this->serial, $this->checkDigit) = $matches;
    }
}
