<?php

namespace byrokrat\banking;

class BankgiroTest extends \PHPUnit_Framework_TestCase
{
    public function invalidStructuresProvider()
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
            ['1234,5805-6200']
        ];
    }

    /**
     * @dataProvider invalidStructuresProvider
     * @expectedException byrokrat\banking\Exception\InvalidStructureException
     */
    public function testInvalidStructure($number)
    {
        new Bankgiro($number);
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

    /**
     * @dataProvider invalidCheckDigitProvider
     * @expectedException byrokrat\banking\Exception\InvalidCheckDigitException
     */
    public function testInvalidCheckDigit($number)
    {
        new Bankgiro($number);
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
            ['5805-6201']
        ];
    }

    /**
     * @dataProvider validProvider
     */
    public function testValidNumber($number)
    {
        $this->assertTrue(!!new Bankgiro($number));
    }

    public function testToString()
    {
        $this->assertSame(
            '5050-1055',
            (string)new Bankgiro('5050-1055')
        );

        $this->assertSame(
            '550-1051',
            (string)new Bankgiro('550-1051')
        );
    }

    public function testGet16()
    {
        $this->assertSame(
            '0000000005501051',
            (new Bankgiro('550-1051'))->get16()
        );
    }

    public function testGetBankName()
    {
        $this->assertSame(
            'Bankgiro',
            (new Bankgiro('5050-1055'))->getBankName()
        );
    }
}
