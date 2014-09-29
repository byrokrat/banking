<?php

namespace ledgr\banking;

class PlusGiroTest extends \PHPUnit_Framework_TestCase
{
    public function invalidStructuresProvider()
    {
        return [
            ['-1'],
            ['-12'],
            ['1-'],
            ['1'],
            ['1-12'],
            ['12345678'],
            ['12345678-1'],
            ['1234567-12'],
            ['1234,9048-0']
        ];
    }

    /**
     * @dataProvider invalidStructuresProvider
     * @expectedException ledgr\banking\Exception\InvalidStructureException
     */
    public function testInvalidStructure($number)
    {
        new PlusGiro($number);
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

    /**
     * @dataProvider invalidCheckDigitProvider
     * @expectedException ledgr\banking\Exception\InvalidCheckDigitException
     */
    public function testInvalidCheckDigit($number)
    {
        new PlusGiro($number);
    }

    public function validProvider()
    {
        return [
            ['210918-9'],
            ['4395094-8'],
            ['956404-8'],
            ['465658-3'],
            ['205835-2'],
            ['9048-0']
        ];
    }

    /**
     * @dataProvider validProvider
     */
    public function testValidNumber($number)
    {
        $this->assertTrue(!!new PlusGiro($number));
    }

    public function testToString()
    {
        $this->assertSame(
            '9048-0',
            (string)new PlusGiro('9048-0')
        );
    }

    public function testTo16()
    {
        $this->assertSame(
            '0000000000090480',
            (new PlusGiro('9048-0'))->to16()
        );
    }

    public function testGetType()
    {
        $this->assertSame(
            'PlusGiro',
            (new PlusGiro('9048-0'))->getType()
        );
    }
}
