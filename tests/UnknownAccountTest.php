<?php

namespace ledgr\banking;

class UnknownAccountTest extends \PHPUnit_Framework_TestCase
{
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

    /**
     * @expectedException ledgr\banking\Exception\InvalidStructureException
     * @dataProvider invalidStructureProvider
     */
    public function testInvalidStructure($number)
    {
        new UnknownAccount($number);
    }

    public function validProvider()
    {
        return [
            ['1234,1234567'],
            ['1234,1234567890'],
            ['12341234567'],
            ['1234000001234567']
        ];
    }

    /**
     * @dataProvider validProvider
     */
    public function testValidStructure($number)
    {
        $this->assertTrue(!!new UnknownAccount($number));
    }

    public function testToString()
    {
        $this->assertSame(
            '1234,1234567',
            (string)new UnknownAccount('1234,1234567')
        );
    }

    public function testTo16()
    {
        $this->assertSame(
            '1234000001234567',
            (new UnknownAccount('1234,1234567'))->to16()
        );
    }

    public function testGetType()
    {
        $this->assertSame(
            'Unknown',
            (new UnknownAccount('1234,1234567'))->getType()
        );
    }
}
