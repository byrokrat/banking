<?php

namespace byrokrat\banking;

use byrokrat\id\PersonalId;

/**
 * Account number where the serial number is a swedish personal id
 */
class NordeaPersonal extends BaseAccount
{
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
}
