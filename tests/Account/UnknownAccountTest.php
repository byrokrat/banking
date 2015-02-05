<?php

namespace byrokrat\banking\Account;

/**
 * @covers \byrokrat\banking\Account\Unknown
 */
class UnknownAccountTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'Unknown';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\Unknown';
    }

    public function invalidStructureProvider()
    {
        return [
            ['123,1234567'],
            ['12345,1234567'],
            ['1234,123456'],
            ['1234,1234567890123'],
            ['1234123456'],
            ['00001234567'],
        ];
    }

    public function validProvider()
    {
        return [
            ['1234,1234567',     '1234', '', '123456', '7'],
            ['1234,123456789-0', '1234', '', '123456789', '0'],
            ['12341234567',      '1234', '', '123456', '7'],
            ['1234000001234567', '1234', '', '00000123456', '7'],
        ];
    }
}
