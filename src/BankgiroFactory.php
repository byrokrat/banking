<?php

namespace byrokrat\banking;

/**
 * Plusgiroi account number factory
 */
class BankgiroFactory extends AccountFactory implements BankNames
{
    public function __construct()
    {
        $formats = (new FormatFactory)->createFormats();
        parent::__construct([self::FORMAT_BANKGIRO => $formats[self::FORMAT_BANKGIRO]]);
    }

    /**
     * Create bankgiro account object using number
     *
     * @param  string $number
     * @return AccountNumber
     * @throws Exception\UnableToCreateAccountException If unable to create
     */
    public function createAccount($number)
    {
        return parent::createAccount($number);
    }
}
