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
 * Simple AccountNumber factory
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class AccountFactory
{
    /**
     * @var string[] List of possible account classes
     */
    private $classes = array(
        'NordeaPersonal',
        'NordeaType1A',
        'NordeaType1B',
        'SwedbankType1',
        'SwedbankType2',
        'SEB',
        'PlusGiro',
        'Bankgiro',
        'UnknownAccount'
    );

    /**
     * Set list of possibla account classes
     *
     * @param string[] $classes
     */
    public function __construct(array $classes = null)
    {
        if ($classes) {
            $this->classes = $classes;
        }
    }

    /**
     * Create bank account object from account number
     *
     * @param  string $number
     * @return AccountNumber
     * @throws Exception\UnableToCreateAccountException If unable to create
     */
    public function create($number)
    {
        foreach ($this->classes as $classname) {
            try {
                $classname = "\\ledgr\\banking\\$classname";
                return new $classname($number);
            } catch (Exception\InvalidAccountNumberException $e) {
                continue;
            }
        }

        throw new Exception\UnableToCreateAccountException("Unable to create account using number <{$number}>");
    }
}
