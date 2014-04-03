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

use ledgr\banking\Exception\UnableToCreateBankAccountException;

/**
 * Create bank account object from account number
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class BankAccountFactory
{
    /**
     * @var array List of possible account classes
     */
    private static $classes = array(
        'NordeaPerson',
        'NordeaTyp1A',
        'NordeaTyp1B',
        'SwedbankTyp1',
        'SwedbankTyp2',
        'SEB',
        'PlusGiro',
        'Bankgiro',
        'UnknownAccount'
    );

    /**
     * Create bank account object from account number
     *
     * @param  string               $account Clearing + , + account number
     * @return BankAccountInterface
     * @throws Exception            If unable to create
     */
    public static function create($account)
    {
        foreach (self::$classes as $class) {
            try {
                // Create and return account object
                $class = "\\ledgr\\banking\\$class";
                return new $class($account);
            } catch (Exception $e) {
                // Invalid clearing, try next class
                continue;
            }
        }

        // Unable to create class
        throw new UnableToCreateBankAccountException("Unable to create account for number <{$account}>");
    }
}
