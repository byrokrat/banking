<?php

namespace byrokrat\banking\Validator;

class ClearingValidatorTest extends \PHPUnit\Framework\TestCase
{
    public function getValidator()
    {
        return new ClearingValidator(
            [
                [1000, 1999],
                [3000, 3999]
            ]
        );
    }

    public function validProvider()
    {
        return [
            ['1000'],
            ['1999'],
            ['3022']
        ];
    }

    /**
     * @dataProvider validProvider
     */
    public function testValidClearing($clearing)
    {
        $number = $this->getMockBuilder('byrokrat\banking\AccountNumber')->getMock();
        $number->expects($this->any())
            ->method('getClearingNumber')
            ->will($this->returnValue($clearing));

        $this->assertNull($this->getValidator()->validate($number));
    }

    public function invalidProvider()
    {
        return [
            ['2000'],
            ['2999'],
            ['5349']
        ];
    }

    /**
     * @dataProvider invalidProvider
     */
    public function testExceptionOnInvalidClearing($clearing)
    {
        $number = $this->getMockBuilder('byrokrat\banking\AccountNumber')->getMock();
        $number->expects($this->any())
            ->method('getClearingNumber')
            ->will($this->returnValue($clearing));

        $this->expectException('byrokrat\banking\Exception\InvalidClearingNumberException');
        $this->getValidator()->validate($number);
    }
}
