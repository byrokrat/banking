<?php

namespace ledgr\banking;

class NordeaType1BTest extends \PHPUnit_Framework_TestCase
{
    public function invalidStructuresProvider()
    {
        return [
            ['4000,111111'],
            ['4000,11111'],
            ['4000,11111111'],
            ['4000,0000001111111']
        ];
    }

    /**
     * @dataProvider invalidStructuresProvider
     * @expectedException ledgr\banking\Exception\InvalidStructureException
     */
    public function testInvalidStructure($number)
    {
        new NordeaType1B($number);
    }

    public function invalidClearingProvider()
    {
        return [
            ['3999,1234567'],
            ['5000,1234567']
        ];
    }

    /**
     * @expectedException ledgr\banking\Exception\InvalidClearingNumberException
     * @dataProvider invalidClearingProvider
     */
    public function testInvalidClearing($number)
    {
        new NordeaType1B($number);
    }

    public function testInvalidCheckDigit()
    {
        $this->setExpectedException('ledgr\banking\Exception\InvalidCheckDigitException');
        new NordeaType1B('4000,1111111');
    }

    public function validProvider()
    {
        return [
            ['4000,1111112'],
            ['4000,000001111112']
        ];
    }

    /**
     * @dataProvider validProvider
     */
    public function testValidNumber($number)
    {
        new NordeaType1B($number);
        $this->assertTrue(true);
    }

    public function testToString()
    {
        $this->assertSame(
            '4000,1111112',
            (string)new NordeaType1B('4000,000001111112')
        );
    }

    public function testTo16()
    {
        $this->assertSame(
            '4000000001111112',
            (new NordeaType1B('4000,1111112'))->to16()
        );
    }

    public function testGetType()
    {
        $this->assertSame(
            'Nordea',
            (new NordeaType1B('4000,1111112'))->getType()
        );
    }
}
