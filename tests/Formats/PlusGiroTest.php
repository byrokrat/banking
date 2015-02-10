<?php

namespace byrokrat\banking;

/**
 * @covers \byrokrat\banking\PlusGiro
 */
class PlusGiroTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_PLUSGIRO;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_PLUSGIRO;
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
            ['00000000000000018'],
        ];
    }

    public function invalidCheckDigitProvider()
    {
        return [
            ['210918-0'],
            ['4395094-0'],
            ['956404-0'],
            ['465658-0'],
            ['205835-0'],
            ['9048-1'],
        ];
    }

    public function validProvider()
    {
        return [
            ['210918-9',  '0000', '', '210918',  '9'],
            ['4395094-8', '0000', '', '4395094', '8'],
            ['956404-8',  '0000', '', '956404',  '8'],
            ['465658-3',  '0000', '', '465658',  '3'],
            ['205835-2',  '0000', '', '205835',  '2'],
            ['9048-0',    '0000', '', '9048',    '0'],
            ['90480',     '0000', '', '9048',    '0'],
        ];
    }
}
