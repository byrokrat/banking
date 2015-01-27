<?php

namespace byrokrat\banking;

class NordeaType1ATest extends \PHPUnit_Framework_TestCase
{
    public function invalidStructuresProvider()
    {
        return [
            ['3000,111111'],
            ['3000,11111'],
            ['3000,11111111'],
            ['3000,0000001111111']
        ];
    }

    /**
     * @dataProvider invalidStructuresProvider
     * @expectedException byrokrat\banking\Exception\InvalidStructureException
     */
    public function testInvalidStructure($number)
    {
        new NordeaType1A($number);
    }

    public function invalidClearingProvider()
    {
        return [
            ['1099,1234567'],
            ['1200,1234567'],
            ['1399,1234567'],
            ['2100,1234567'],
            ['2999,1234567'],
            ['3300,1234567'],
            ['3400,1234567'],
            ['3409,1234567'],
            ['3782,1234567'],
            ['4000,1234567']
        ];
    }

    /**
     * @expectedException byrokrat\banking\Exception\InvalidClearingNumberException
     * @dataProvider invalidClearingProvider
     */
    public function testInvalidClearing($number)
    {
        new NordeaType1A($number);
    }

    public function invalidCheckDigitProvider()
    {
        return [
            ['3000,1111111'],
            ['3032,0050011'],
            ['3017,0108601'],
            ['3030,0377311'],
            ['1405,3542562'],
            ['3045,0147421'],
            ['3045,0156691']
        ];
    }

    /**
     * @dataProvider invalidCheckDigitProvider
     * @expectedException byrokrat\banking\Exception\InvalidCheckDigitException
     */
    public function testInvalidCheckDigit($number)
    {
        new NordeaType1A($number);
    }

    public function validProvider()
    {
        return [
            ['3000,1111116'],
            ['3000,000001111116'],
            ['3032,0050017'],
            ['3017,0108600'],
            ['3030,0377312'],
            ['1405,3542561'],
            ['3045,0147428'],
            ['3045,0156699']
        ];
    }

    /**
     * @dataProvider validProvider
     */
    public function testValidNumber($number)
    {
        $this->assertTrue(!!new NordeaType1A($number));
    }

    public function testToString()
    {
        $this->assertSame(
            '3000,1111116',
            (string)new NordeaType1A('3000,000001111116')
        );
    }

    public function testGet16()
    {
        $this->assertSame(
            '3000000001111116',
            (new NordeaType1A('3000,1111116'))->get16()
        );
    }

    public function testGetBankName()
    {
        $this->assertSame(
            'Nordea',
            (new NordeaType1A('3000,1111116'))->getBankName()
        );
    }
}
