<?php
/**
 * This file is part of ledgr/banking.
 *
 * Copyright (c) 2014 Hannes Forsgård
 *
 * ledgr/banking is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * ledgr/banking is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ledgr/banking.  If not, see <http://www.gnu.org/licenses/>.
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
