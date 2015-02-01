<?php

namespace byrokrat\banking;

use byrokrat\id\PersonalId;
use byrokrat\id\Exception\RuntimeException as IdException;
use byrokrat\id\Exception\InvalidCheckDigitException as IdInvalidCheckDigitException;

/**
 * Account number where serial number is a swedish personal id
 */
class NordeaPersonal implements AccountNumber
{
    use Component\Constructor;

    /**
     * @var PersonalId Id associated with account number
     */
    private $personalId;

    /**
     * Get name of Bank this number belongs to (implements AccountNumber)
     */
    public function getBankName()
    {
        return 'Nordea';
    }

    /**
     * Get personal id associated with this account number
     *
     * @return PersonalId
     */
    public function getPersonalId()
    {
        return $this->personalId;
    }

    /**
     * Get regular expression describing structure (from Component\Constructor)
     *
     * @return string
     */
    protected function getStructure()
    {
        return "/^(\d{4})?,?0{0,2}(\d{9})(\d)$/";
    }

    /**
     * Validate clearing number (from Component\Constructor)
     *
     * @return boolean
     */
    protected function isValidClearing()
    {
        // Default clearing number for personal accounts
        $this->clearing = $this->clearing ?: '3300';
        return $this->clearing == '3300' || $this->clearing == '3782';
    }

    /**
     * Validate check digit (from Component\Constructor)
     *
     * Personal accounts are personal id numbers
     *
     * @return boolean
     * @throws If account number is not a valid personal id
     */
    protected function isValidCheckDigit()
    {
        $idNumber = $this->getSerialNumber() . $this->getCheckDigit();

        try {
            $this->personalId = new PersonalId($idNumber);
        } catch (IdInvalidCheckDigitException $e) {
            return false;
        } catch (IdException $e) {
            throw new Exception\InvalidAccountNumberException(
                "Account number <$idNumber> is not a valid personal id number",
                0,
                $e
            );
        }

        return true;
    }
}
