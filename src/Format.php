<?php

namespace byrokrat\banking;

use byrokrat\banking\Exception\LogicException;
use byrokrat\banking\Exception\InvalidStructureException;

/**
 * Account number parsing format
 */
class Format
{
    /**
     * @var string Name of bank parsed account belongs to
     */
    private $bankName;

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
     * @param string      $bankName   Name of bank parsed account belongs to
     * @param string      $structure  Parsing regular expression
     * @param string      $classname  Name of class to create
     * @param Validator[] $validators Validators to apply
     */
    public function __construct($bankName, $structure, $classname, array $validators)
    {
        $this->bankName = $bankName;
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
        if (!preg_match($this->structure, $number, $matches)) {
            throw new InvalidStructureException("Invalid account number structure $number");
        }

        if (count($matches) != 5) {
            throw new LogicException('Parsing regexp must grep 4 values from number');
        }

        /** @var AccountNumber $account */
        $account = new $this->classname($this->bankName, $number, $matches[1], $matches[2], $matches[3], $matches[4]);

        foreach ($this->validators as $validator) {
            $validator->validate($account);
        }

        return $account;
    }

    public function has_validator($class_name)
    {
        foreach($this->validators as $validator) {
            if(is_a($validator, $class_name)) {
                return TRUE;
            }
        }

        return FALSE;
    }

    public function get_validator($class_name)
    {
        foreach($this->validators as $validator) {
            if(is_a($validator, $class_name)) {
                return $validator;
            }
        }

        return FALSE;
    }
}
