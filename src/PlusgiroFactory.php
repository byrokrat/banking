<?php

namespace byrokrat\banking;

/**
 * Plusgiroi account number factory
 */
class PlusgiroFactory extends AccountFactory implements BankNames
{
    public function __construct()
    {
        $formats = (new FormatFactory)->createFormats();
        parent::__construct([self::FORMAT_PLUSGIRO => $formats[self::FORMAT_PLUSGIRO]]);
    }

    /**
     * Create plusgiro account object using number
     *
     * @param  string $number
     * @return PlusGiro
     * @throws Exception\UnableToCreateAccountException If unable to create
     */
    public function createAccount($number)
    {
        return parent::createAccount($number);
    }
}
