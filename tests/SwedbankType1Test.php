<?php

namespace byrokrat\banking;

class SwedbankType1Test extends \PHPUnit_Framework_TestCase
{
    public function invalidStructuresProvider()
    {
        return array(
            array('7000,111111'),
            array('7000,11111'),
            array('7000,11111111'),
            array('7000,0000001111111'),
        );
    }

    /**
     * @dataProvider invalidStructuresProvider
     * @expectedException byrokrat\banking\Exception\InvalidStructureException
     */
    public function testInvalidStructure($number)
    {
        new SwedbankType1($number);
    }

    public function invalidClearingProvider()
    {
        return array(
            array('6999,1111111'),
            array('8000,1111111'),
        );
    }

    /**
     * @expectedException byrokrat\banking\Exception\InvalidClearingNumberException
     * @dataProvider invalidClearingProvider
     */
    public function testInvalidClearing($number)
    {
        new SwedbankType1($number);
    }

    public function invalidCheckDigitProvider()
    {
        return array(
            array('7000,1111111'),
            array('7822,1420650'),
            array('7950,1450700'),
        );
    }

    /**
     * @dataProvider invalidCheckDigitProvider
     * @expectedException byrokrat\banking\Exception\InvalidCheckDigitException
     */
    public function testInvalidCheckDigit($number)
    {
        new SwedbankType1($number);
    }

    public function validProvider()
    {
        return array(
            array('7000,1111116'),
            array('7000,000001111116'),
            array('7822,1420654'),
            array('7950,1450708'),
        );
    }

    /**
     * @dataProvider validProvider
     */
    public function testConstruct($number)
    {
        $this->assertTrue(!!new SwedbankType1($number));
    }

    public function testToString()
    {
        $swedbank = new SwedbankType1('7000,000001111116');
        $this->assertEquals((string)$swedbank, '7000,1111116');
    }

    public function testGetBankName()
    {
        $swedbank = new SwedbankType1('7000,1111116');
        $this->assertEquals($swedbank->getBankName(), 'Swedbank');
    }
}
