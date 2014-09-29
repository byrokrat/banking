<?php
/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace ledgr\banking\Component;

use ledgr\checkdigit\Modulo10;

/**
 * Helper that implements isValidCheckDigit() for Bankgiro and PlusGiro
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
trait Giro
{
    use Constructor;

    /**
     * Validate check digit (from Component\Constructor)
     *
     * @return boolean
     */
    protected function isValidCheckDigit()
    {
        return Modulo10::verify(
            $this->getSerialNumber() . $this->getCheckDigit()
        );
    }
}
