<?php

namespace byrokrat\banking;

/**
 * Account number for Bankgirot clearing system
 */
class Bankgiro implements AccountNumberInterface, Data\BankNames
{
    use Component\Giro;

    /**
     * Get name of Bank this number belongs to (implements AccountNumber)
     */
    public function getBankName()
    {
        return self::BANK_BANKGIRO;
    }

    /**
     * Get account as string (implements AccountNumber)
     *
     * @return string
     */
    public function getNumber()
    {
        return substr($this->getSerialNumber(), 0, -3)
            . '-'
            . substr($this->getSerialNumber(), -3)
            . $this->getCheckDigit();
    }

    /**
     * Get regular expression describing structure (from Component\Constructor)
     *
     * @return string
     */
    protected function getStructure()
    {
        return "/^(\d{3,4})-(\d{3})(\d)$/";
    }

    /**
     * Load data returned by parsing regular expression (from Component\Constructor)
     *
     * @param  array $matches
     * @return void
     */
    protected function setup(array $matches)
    {
        list($serialPre, $serialPost, $this->checkDigit) = $matches;
        $this->serial = $serialPre.$serialPost;
    }
}
