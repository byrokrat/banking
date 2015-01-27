<?php

namespace byrokrat\banking;

/**
 * Account number null object
 */
class NullAccount implements AccountNumber
{
    use Component\BaseImplementation;

    /**
     * @var string String returned instead of account number
     */
    private static $str = '-';

    /**
     * Set string returned instead of account number
     *
     * @param string $str
     */
    public static function setString($str)
    {
        self::$str = $str;
    }

    public function getNumber()
    {
        return self::$str;
    }

    public function getBankName()
    {
        return '-';
    }
}
