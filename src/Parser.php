<?php

namespace byrokrat\banking;

use byrokrat\banking\Exception\LogicException;
use byrokrat\banking\Exception\InvalidStructureException;

/**
 * Parse account number based on format settings
 */
class Parser
{
    /**
     * @var string Parsing regular expression
     */
    private $structure;

    /**
     * @var string Name of class to create
     */
    private $classname;

    /**
     * @var Validator[] Loaded validators
     */
    private $validators;

    /**
     * Load parser data
     *
     * @param string      $structure  Parsing regular expression
     * @param string      $classname  Name of class to create
     * @param Validator[] $validators Validators to apply
     */
    public function __construct($structure, $classname, array $validators)
    {
        $this->structure = $structure;
        $this->classname = $classname;
        $this->validators = $validators;
    }

    /**
     * Parse raw account number
     *
     * @param  string $number
     * @return AccountNumber
     * @throws LogicException            If regexp does not grep the correct number of values
     * @throws InvalidStructureException If structure is invalid
     */
    public function parse($number)
    {
        if (!preg_match($this->structure, str_replace(' ', '', $number), $matches)) {
            throw new InvalidStructureException("Invalid account number structure $number");
        }

        if (count($matches) != 5) {
            throw new LogicException('Parsing regexp must grep 4 values from number');
        }

        /** @var AccountNumber $account */
        $account = new $this->classname($number, $matches[1], $matches[2], $matches[3], $matches[4]);

        foreach ($this->validators as $validator) {
            $validator->validate($account);
        }

        return $account;
    }
}
