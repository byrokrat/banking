<?php

namespace byrokrat\banking\Account;

/**
 * @covers \byrokrat\banking\Account\PlusGiro
 */
class PlusGiroTest extends AccountNumberTestCase
{
    public function getParserName()
    {
        return 'PlusGiro';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\Plusgiro';
    }

    public function invalidStructureProvider()
    {
        return [
            ['-1'],
            ['-12'],
            ['1-'],
            ['1'],
            ['1-12'],
            ['12345678-1'],
            ['1234567-12'],
            ['1234,9048-0'],
            ['00000000000000018']
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
        return [
            ['210918-0'],
            ['4395094-0'],
            ['956404-0'],
            ['465658-0'],
            ['205835-0'],
            ['9048-1']
        ];
    }

    public function validProvider()
    {
        return [
            ['210918-9'],
            ['4395094-8'],
            ['956404-8'],
            ['465658-3'],
            ['205835-2'],
            ['9048-0'],
            ['90480']
        ];
    }
}
