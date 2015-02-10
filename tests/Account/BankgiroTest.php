<?php

namespace byrokrat\banking\Account;

/**
 * @covers \byrokrat\banking\Account\Bankgiro
 */
class BankgiroTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'bankgiro';
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
            ['5805-6200'],
        ];
    }

    public function validProvider()
    {
        return [
            ['5050-1055', '0000', '', '5050105', '5'],
            ['5897-5616', '0000', '', '5897561', '6'],
            ['784-8419',  '0000', '', '784841', '9'],
            ['5331-1338', '0000', '', '5331133', '8'],
            ['5645-2725', '0000', '', '5645272', '5'],
            ['5588-8077', '0000', '', '5588807', '7'],
            ['5694-8227', '0000', '', '5694822', '7'],
            ['5805-6201', '0000', '', '5805620', '1'],
        ];
    }
}
