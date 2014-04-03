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
 * BankAccountInterface null object
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class NullAccount implements BankAccountInterface
{
    /**
     * @var string String returned instead of account number
     */
    private static $str = '-';

    /**
     * Set string returned instead of account number
     *
     * @param  string $str
     * @return void
     */
    public static function setString($str)
    {
        self::$str = $str;
    }

    public function __toString()
    {
        return $this->getNumber();
    }

    public function to16()
    {
        return $this->getNumber();
    }

    public function getClearing()
    {
        return '-';
    }

    public function getNumber()
    {
        return self::$str;
    }

    public function getType()
    {
        return '-';
    }
}
