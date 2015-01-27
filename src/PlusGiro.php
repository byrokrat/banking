<?php

namespace byrokrat\banking;

/**
 * Account number for PlusGirot (formerly PostGirot) clearing system
 */
class PlusGiro implements AccountNumber
{
    use Component\Giro;

    /**
     * Get name of Bank this number belongs to (implements AccountNumber)
     */
    public function getBankName()
    {
        return self::BANK_PLUSGIRO;
    }

    /**
     * Get account as string (implements AccountNumber)
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->getSerialNumber()
            . '-'
            . $this->getCheckDigit();
    }

    /**
     * Get regular expression describing structure (from Component\Constructor)
     *
     * @return string
     */
    protected function getStructure()
    {
        return "/^(\d{1,7})-(\d)$/";
    }

    /**
     * Load data returned by parsing regular expression (from Component\Constructor)
     *
     * @param  array $matches
     * @return void
     */
    protected function setup(array $matches)
    {
        list($this->serial, $this->checkDigit) = $matches;
    }
}
