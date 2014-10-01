<?php

namespace ledgr\banking;

class SEBTest extends \PHPUnit_Framework_TestCase
{
    public function invalidStructuresProvider()
    {
        return [
            ['5000,111111'],
            ['5000,11111'],
            ['5000,11111111'],
            ['5000,0000001111111']
        ];
    }

    /**
     * @dataProvider invalidStructuresProvider
     * @expectedException ledgr\banking\Exception\InvalidStructureException
     */
    public function testInvalidStructure($number)
    {
        new SEB($number);
    }

    public function invalidClearingProvider()
    {
        return [
            ['4999,1111111'],
            ['6000,1111111'],
            ['9119,1111111'],
            ['9125,1111111'],
            ['9129,1111111'],
            ['9150,1111111']
        ];
    }

    /**
     * @expectedException ledgr\banking\Exception\InvalidClearingNumberException
     * @dataProvider invalidClearingProvider
     */
    public function testInvalidClearing($number)
    {
        new SEB($number);
    }

    public function invalidCheckDigitProvider()
    {
        return [
            ['5000,1111111'],
            ['5681,0047150'],
            ['5102,0158750'],
            ['5624,0179270'],
            ['5011,0137390'],
            ['5169,0027450'],
            ['5007,0042700'],
            ['5502,0038521'],
            ['5504,0017150'],
            ['5624,0017790']
        ];
    }

    /**
     * @dataProvider invalidCheckDigitProvider
     * @expectedException ledgr\banking\Exception\InvalidCheckDigitException
     */
    public function testInvalidCheckDigit($number)
    {
        new SEB($number);
    }

    public function validProvider()
    {
        return [
            ['5000,1111116'],
            ['5000,000001111116'],
            ['5681,0047158'],
            ['5102,0158751'],
            ['5624,0179272'],
            ['5011,0137396'],
            ['5169,0027452'],
            ['5007,0042705'],
            ['5502,0038520'],
            ['5504,0017154'],
            ['5624,0017795']
        ];
    }

    /**
     * @dataProvider validProvider
     */
    public function testConstruct($number)
    {
        $this->assertTrue(!!new SEB($number));
    }

    public function testToString()
    {
        $this->assertSame(
            '5000,1111116',
            (string)new SEB('5000,000001111116')
        );
    }

    public function testGet16()
    {
        $this->assertSame(
            '5000000001111116',
            (new SEB('5000,1111116'))->get16()
        );
    }

    public function testGetClearingNumber()
    {
        $this->assertSame(
            '5000',
            (new SEB('5000,1111116'))->getClearingNumber()
        );
    }

    public function testGetSerialNumber()
    {
        $this->assertSame(
            '111111',
            (new SEB('5000,1111116'))->getSerialNumber()
        );
        $this->assertSame(
            '111111',
            (new SEB('5000,001111116'))->getSerialNumber()
        );
    }

    public function testGetBankName()
    {
        $this->assertSame(
            'SEB',
            (new SEB('5000,1111116'))->getBankName()
        );
    }
}
