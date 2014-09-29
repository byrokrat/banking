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
 * Account number for Bankgirot clearing system
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class Bankgiro implements AccountNumber
{
    use Component\Giro;

    /**
     * Get string describing account type (implements AccountNumber)
     *
     * @return string
     */
    public function getType()
    {
        return "Bankgiro";
    }

    /**
     * Get account as string (implements AccountNumber)
     *
     * @return string
     */
    public function getNumber()
    {
        return substr($this->getSerialNumber(), 0, -3)
            . '-'
            . substr($this->getSerialNumber(), -3)
            . $this->getCheckDigit();
    }

    /**
     * Get regular expression describing structure (from Component\Constructor)
     *
     * @return string
     */
    protected function getStructure()
    {
        return "/^(\d{3,4})-(\d{3})(\d)$/";
    }

    /**
     * Load data returned by parsing regular expression (from Component\Constructor)
     *
     * @param  array $matches
     * @return void
     */
    protected function setup(array $matches)
    {
        list($serialPre, $serialPost, $this->checkDigit) = $matches;
        $this->serial = $serialPre.$serialPost;
    }
}
