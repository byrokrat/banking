<?php
/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace ledgr\banking;

use ledgr\checkdigit\Modulo11;

/**
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class SEB extends AbstractBankAccount
{
    public function getType()
    {
        return "SEB";
    }

    public function __tostring()
    {
        return $this->getClearing() . ',' . substr($this->getNumber(), strlen($this->getNumber()) - 7);
    }

    protected function getStructure()
    {
        return "/^0{0,5}\d{7}$/";
    }

    protected function isValidClearing()
    {
        return (
            ( $this->getClearing() >= 5000 && $this->getClearing() <= 5999 )
            || ( $this->getClearing() >= 9120 && $this->getClearing() <= 9124 )
            || ( $this->getClearing() >= 9130 && $this->getClearing() <= 9149 )
        );
    }

    protected function isValidCheckDigit()
    {
        return Modulo11::verify(
            substr($this->getClearing(), 1) . substr($this->getNumber(), strlen($this->getNumber()) - 7)
        );
    }
}
