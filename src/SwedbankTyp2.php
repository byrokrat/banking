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
class SwedbankTyp2 extends AbstractBankAccount
{
    public function getType()
    {
        return "Swedbank";
    }

    public function __tostring()
    {
        return $this->getClearing() . ',' . ltrim($this->getNumber(), '0');
    }

    protected function getStructure()
    {
        return "/^0{0,2}\d{2,10}$/";
    }

    protected function isValidClearing()
    {
        return $this->getClearing() >= 8000 && $this->getClearing() <= 8999;
    }

    protected function isValidCheckDigit()
    {
        return Modulo10::verify(
            ltrim($this->getNumber(), '0')
        );
    }
}
