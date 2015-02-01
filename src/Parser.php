<?php

namespace byrokrat\banking;

/**
 * Create AccountNumber based on parsing settings
 */
class Parser
{
    /**
     * @var string Name of class to create
     */
    private $classname;

    /**
     * @var string Account number structure
     */
    private $structure;

    /**
     * @var array List of clearing number max and min values
     */
    private $clearingRanges;

    /**
     * @var Validator\Validator[] Registered validators
     */
    private $validators;

    /**
     * Load parser data
     *
     * @param string                $classname
     * @param string                $structure
     * @param array                 $clearingRanges
     * @param Validator\Validator[] $validators
     */
    public function __construct($classname, $structure, array $clearingRanges, array $validators)
    {
        $this->classname = $classname;
        $this->structure = $structure;
        $this->clearingRanges = $clearingRanges;
        $this->validators = $validators;
    }

    /**
     * Parse account number
     *
     * @param  string $number
     * @return AccountNumber
     * @throws Exception\LogicException                 If regexp does not grep the correct number of values
     * @throws Exception\InvalidStructureException      If structure is invalid
     * @throws Exception\InvalidClearingNumberException If clearing number is invalid
     */
    public function parse($number)
    {
        $number = str_replace(' ', '', $number);

        if (!preg_match($this->structure, $number, $matches)) {
            throw new Exception\InvalidStructureException("Invalid account number structre $number");
        }

        if (count($matches) != 5) {
            throw new Exception\LogicException('Parsing regexp must grep 4 values from number');
        }

        list(, $clearing, $clearingCheckDigit, $serial, $checkDigit) = $matches;

        $validClearing = false;

        foreach ($this->clearingRanges as $clearingRange) {
            if ((int)$clearing >= $clearingRange[0] && (int)$clearing <= $clearingRange[1]) {
                $validClearing = true;
                break;
            }
        }

        if (!$validClearing) {
            throw new Exception\InvalidClearingNumberException("Invalid clearing number in $number");
        }

        $account = new $this->classname($clearing, $clearingCheckDigit, $serial, $checkDigit);

        foreach ($this->validators as $validator) {
            $validator->validate($account);
        }

        return $account;
    }
}
