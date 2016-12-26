<?php

namespace byrokrat\banking;

use byrokrat\id\PersonalId;

/**
 * Account number where the serial number is a swedish personal id
 */
class NordeaPersonal extends BaseAccount
{
    /**
     * Default to clearing 3300 if no clearing is specified
     */
    public function getClearingNumber()
    {
        return parent::getClearingNumber() ?: '3300';
    }

    /**
     * Get personal id associated with this account number
     *
     * @return PersonalId
     */
    public function getPersonalId()
    {
        return new PersonalId($this->getSerialNumber() . $this->getCheckDigit());
    }

    /**
     * Strip optional delimiter from serial number
     *
     * @return string
     */
    public function getSerialNumber()
    {
        return str_replace('-', '', parent::getSerialNumber());
    }

    /**
     * Format account number as personal id
     */
    public function getNumber()
    {
        return sprintf(
            '%s,%s-%s%s',
            $this->getClearingNumber(),
            substr($this->getSerialNumber(), 0, -3),
            substr($this->getSerialNumber(), -3),
            $this->getCheckDigit()
        );
    }
}
