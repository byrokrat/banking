<?php

namespace byrokrat\banking\Account;

/**
 * @covers \byrokrat\banking\Account\Bankgiro
 */
class BankgiroTest extends AccountNumberTestCase
{
    public function getParserName()
    {
        return 'Bankgiro';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\Bankgiro';
    }

    public function invalidStructureProvider()
    {
        return [
            ['-1234'],
            ['1-1234'],
            ['12-1234'],
            ['12345-1234'],
            ['123'],
            ['123-'],
            ['123-1'],
            ['123-12'],
            ['123-123'],
            ['123-12345'],
            [''],
            ['1234,5805-6200'],
            ['00000000011114444'],
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
            ['5050-1050'],
            ['5897-5610'],
            ['784-8410'],
            ['5331-1330'],
            ['5645-2720'],
            ['5588-8070'],
            ['5694-8220'],
            ['5805-6200']
        ];
    }

    public function validProvider()
    {
        return [
            ['5050-1055'],
            ['5897-5616'],
            ['784-8419'],
            ['5331-1338'],
            ['5645-2725'],
            ['5588-8077'],
            ['5694-8227'],
            ['5805-6201'],
        ];
    }
}
