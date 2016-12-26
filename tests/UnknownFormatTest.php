<?php

namespace byrokrat\banking;

class UnknownFormatTest extends \PHPUnit_Framework_TestCase
{
    public function validProvider()
    {
        return [
            ['1000,1234567',     '1000', '123456', '7'],
            ['1000,123456789-0', '1000', '123456789', '0'],
            ['10001234567',      '1000', '123456', '7'],
            ['1000000001234567', '1000', '00000123456', '7'],
        ];
    }

    /**
     * @dataProvider validProvider
     */
    public function testUnknownFormat($raw, $clearing, $serial, $check)
    {
        $account = (new UnknownFormat)->parse($raw);
        $this->assertInstanceOf('byrokrat\banking\BaseAccount', $account);
        $this->assertSame($clearing, $account->getClearingNumber());
        $this->assertSame($serial, $account->getSerialNumber());
        $this->assertSame($check, $account->getCheckDigit());
    }

    public function invalidStructureProvider()
    {
        return [
            ['123,1234567'],
            ['12345,1234567'],
            ['1234,123456'],
            ['1234,1234567890123'],
            ['1234123456'],
            ['00001234567'],
        ];
    }

    /**
     * @dataProvider invalidStructureProvider
     */
    public function testInvalidStructure($number)
    {
        $this->setExpectedException('byrokrat\banking\Exception\InvalidStructureException');
        (new UnknownFormat)->parse($number);
    }
}
