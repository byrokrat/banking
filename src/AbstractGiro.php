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
abstract class AbstractGiro extends AbstractBankAccount
{
    public function __tostring()
    {
        return $this->getNumber();
    }

    protected function isValidClearing()
    {
        return ($this->getClearing() == '0000');
    }

    protected function isValidCheckDigit()
    {
        return Modulo10::verify(
            str_replace('-', '', $this->getNumber())
        );
    }
}
