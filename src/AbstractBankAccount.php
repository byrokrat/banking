<?php
/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace ledgr\banking;

use ledgr\banking\Exception\InvalidClearingException;
use ledgr\banking\Exception\InvalidStructureException;
use ledgr\banking\Exception\InvalidCheckDigitException;

/**
 * Abstract account number
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
abstract class AbstractBankAccount implements BankAccountInterface
{
    /**
     * @var string Clearing number
     */
    private $clear;

    /**
     * @var string Account number
     */
    private $nr;

    /**
     * Constructor
     *
     * @param  string                     $nr The account number
     * @throws InvalidClearingException   If clearing number is invalid
     * @throws InvalidStructureException  If structure is invalid
     * @throws InvalidCheckDigitException If check digit is invalid
     */
    public function __construct($nr)
    {
        $nr = str_replace(' ', '', $nr);

        $arr = explode(',', $nr, 2);
        if (count($arr) == 1) {
            $this->clear = '0000';
            $this->nr = $arr[0];
        } else {
            $this->clear = $arr[0];
            $this->nr = $arr[1];
        }

        if (strlen($this->clear) != 4
            || !ctype_digit($this->clear)
            || !$this->isValidClearing()
        ) {
            throw new InvalidClearingException("Invalid clearing number for <$nr>");
        }

        if (!$this->isValidStructure()) {
            throw new InvalidStructureException("Invalid account number structre for <$nr>");
        }

        if (!$this->isValidCheckDigit()) {
            throw new InvalidCheckDigitException("Invalid check digit for <$nr>");
        }
    }

    /**
     * Get account as string
     *
     * @return string
     */
    public function __tostring()
    {
        return "{$this->getClearing()},{$this->getNumber()}";
    }

    /**
     * Get account as a 16 digit number
     *
     * @return string
     */
    public function to16()
    {
        return $this->clear . str_pad($this->nr, 12, '0', STR_PAD_LEFT);
    }

    /**
     * Get clearing number
     *
     * @return string
     */
    public function getClearing()
    {
        return $this->clear;
    }

    /**
     * Get account number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->nr;
    }

    /**
     * Get string describing account structure
     *
     * @return string
     */
    abstract protected function getStructure();

    /**
     * Validate account number structure
     *
     * @return bool
     */
    protected function isValidStructure()
    {
        return (boolean)preg_match($this->getStructure(), $this->getNumber());
    }

    /**
     * Validate clearing number
     *
     * @return bool
     */
    abstract protected function isValidClearing();

    /**
     * Validate account number check digit
     *
     * @return bool
     */
    abstract protected function isValidCheckDigit();
}
