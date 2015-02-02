<?php

namespace byrokrat\banking;

class AccountFactoryOld
{
    /**
     * @var string[]
     */
    private $classes = array(
        "\\byrokrat\\banking\\Bankgiro"
    );

    /**
     * @param  string $number
     * @return AccountNumber
     */
    public function create($number)
    {
        foreach ($this->classes as $classname) {
            try {
                return new $classname($number);
            } catch (Exception\InvalidAccountNumberException $e) {
                continue;
            }
        }
        throw new Exception\UnableToCreateAccountException();
    }
}
