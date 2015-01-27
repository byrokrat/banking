<?php

namespace byrokrat\banking;

/**
 * Fake account, all is valid
 */
class UnknownAccount implements AccountNumber
{
    use Component\Constructor;

    /**
     * Get name of Bank this number belongs to (implements AccountNumber)
     */
    public function getBankName()
    {
        return "Unknown";
    }

    /**
     * Get regular expression describing structure (from Component\Constructor)
     *
     * @return string
     */
    protected function getStructure()
    {
        return "/^(\d{4}),?(\d{6,11})(\d)$/";
    }
}
