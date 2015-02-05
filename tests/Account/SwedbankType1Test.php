<?php

namespace byrokrat\banking\Account;

/**
 * @covers \byrokrat\banking\Account\Swedbank
 */
class SwedbankType1Test extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'SwedbankType1';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\Swedbank';
    }

    public function invalidStructureProvider()
    {
        return [
            ['7000,111111'],
            ['7000,11111'],
            ['7000,11111111'],
            ['7000,0000001111111'],
        ];
    }

    public function invalidClearingProvider()
    {
        return [
            ['6999,1111111'],
            ['8000,1111111'],
        ];
    }

    public function invalidCheckDigitProvider()
    {
        return [
            ['7000,1111111'],
            ['7822,1420650'],
            ['7950,1450700'],
        ];
    }

    public function validProvider()
    {
        return [
            ['7000,1111116',      '7000', '', '111111', '6'],
            ['7000,000001111116', '7000', '', '111111', '6'],
            ['78221420654',       '7822', '', '142065', '4'],
            ['7950,145070-8',     '7950', '', '145070', '8'],
        ];
    }
}
