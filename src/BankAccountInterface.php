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
 * Account interface
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
interface BankAccountInterface
{
    /**
     * Get account as string
     *
     * @return string
     */
    public function __toString();

    /**
     * Get account as a 16 digit number
     *
     * Clearing number + x number of ceros + account number
     *
     * @return string
     */
    public function to16();

    /**
     * Get clearing number
     *
     * @return string
     */
    public function getClearing();

    /**
     * Get account number
     *
     * @return string
     */
    public function getNumber();

    /**
     * Get string describing account type
     *
     * @return string
     */
    public function getType();
}
