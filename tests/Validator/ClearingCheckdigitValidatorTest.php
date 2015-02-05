<?php

namespace byrokrat\banking\Validator;

class ClearingCheckdigitValidatorTest extends ValidatorTestCase
{
    public function testValidCheckDigit()
    {
        $checksum = $this->getMock('byrokrat\checkdigit\Modulo10');
        $checksum->expects($this->once())
            ->method('isValid')
            ->with('12345')
            ->will($this->returnValue(true));

        $this->assertNull((new ClearingCheckdigitValidator($checksum))->validate(
            $this->getAccountNumberMock()
        ));
    }

    public function testExceptionOnInvalidCheckDigit()
    {
        $checksum = $this->getMock('byrokrat\checkdigit\Modulo10');
        $checksum->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(false));

        $this->setExpectedException('byrokrat\banking\Exception\InvalidCheckDigitException');
        (new ClearingCheckdigitValidator($checksum))->validate(
            $this->getAccountNumberMock()
        );
    }

    public function testIgnoreUnspecifiedCheckDigit()
    {
        $this->assertNull(
            (new ClearingCheckdigitValidator($this->getMock('byrokrat\checkdigit\Modulo10')))->validate(
                $this->getMock('byrokrat\banking\AccountNumber')
            )
        );
    }
}
