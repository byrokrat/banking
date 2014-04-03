<?php
/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
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
