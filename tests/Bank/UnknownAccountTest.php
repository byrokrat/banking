<?php

namespace byrokrat\banking\Bank;

/**
 * @covers \byrokrat\banking\Bank\Unknown
 */
class UnknownAccountTest extends AccountNumberTestCase
{
    public function getParserName()
    {
        return 'Unknown';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Bank\Unknown';
    }

    public function invalidStructureProvider()
    {
        return [
            ['123,1234567'],
            ['12345,1234567'],
            ['1234,123456'],
            ['1234,1234567890123'],
            ['1234123456']
        ];
    }

    public function validProvider()
    {
        return [
            ['1234,1234567'],
            ['1234,123456789-0'],
            ['12341234567'],
            ['1234000001234567']
        ];
    }

    public function invalidClearingProvider()
    {
        return [[null]];
    }

    /**
     * @dataProvider invalidClearingProvider
     */
    public function testInvalidClearing($number)
    {
    }

    public function invalidCheckDigitProvider()
    {
        return [[null]];
    }

    /**
     * @dataProvider invalidCheckDigitProvider
     */
    public function testInvalidCheckDigit($number)
    {
    }
}
