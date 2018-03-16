<?php

namespace byrokrat\banking\Validator;

abstract class ValidatorTestCase extends \PHPUnit\Framework\TestCase
{
    protected function getAccountNumberMock()
    {
        $number = $this->getMockBuilder('byrokrat\banking\AccountNumber')->getMock();
        $number->expects($this->any())
            ->method('getClearingNumber')
            ->will($this->returnValue('1234'));
        $number->expects($this->any())
            ->method('getClearingCheckDigit')
            ->will($this->returnValue('5'));
        $number->expects($this->any())
            ->method('getSerialNumber')
            ->will($this->returnValue('123456'));
        $number->expects($this->any())
            ->method('getCheckDigit')
            ->will($this->returnValue('7'));

        return $number;
    }
}
