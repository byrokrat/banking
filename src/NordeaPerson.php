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
class NordeaPerson extends AbstractBankAccount
{
    public function getType()
    {
        return "Nordea";
    }

    public function __tostring()
    {
        return $this->getClearing() . ',' . substr($this->getNumber(), strlen($this->getNumber()) - 10);
    }

    protected function getStructure()
    {
        return "/^0{0,2}\d{10}$/";
    }

    protected function isValidClearing()
    {
        return $this->getClearing() == 3300 || $this->getClearing() == 3782;
    }

    protected function isValidCheckDigit()
    {
        return Modulo10::verify(
            substr($this->getNumber(), strlen($this->getNumber()) - 10)
        );
    }
}
