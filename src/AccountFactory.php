<?php

namespace byrokrat\banking;

/**
 * Simple AccountNumber factory
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
                $classname = "\\byrokrat\\banking\\$classname";
                return new $classname($number);
            } catch (Exception\InvalidAccountNumberException $e) {
                continue;
            }
        }

        throw new Exception\UnableToCreateAccountException("Unable to create account using number <{$number}>");
    }
}
