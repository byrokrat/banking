<?php

namespace byrokrat\banking;

class AccountFactoryOld
{
    /**
     * @var string[]
     */
    private $classes = array(
        "\\byrokrat\\banking\\NordeaPersonal",
        "\\byrokrat\\banking\\PlusGiro",
        "\\byrokrat\\banking\\Bankgiro"
    );

    /**
     * @param  string $number
     * @return AccountNumberInterface
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
