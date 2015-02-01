<?php

namespace byrokrat\banking\Validator;

class Checkdigit1ATest extends ValidatorTestCase
{
    public function testValidCheckDigit()
    {
        $checksum = $this->getMock('byrokrat\checkdigit\Modulo11');
        $checksum->expects($this->once())
            ->method('isValid')
            ->with('2341234567')
            ->will($this->returnValue(true));

        $this->assertNull((new Checkdigit1A($checksum))->validate(
            $this->getAccountNumberMock()
        ));
    }

    public function testExceptionOnInvalidCheckDigit()
    {
        $checksum = $this->getMock('byrokrat\checkdigit\Modulo11');
        $checksum->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(false));

        $this->setExpectedException('byrokrat\banking\Exception\InvalidCheckDigitException');
        (new Checkdigit1A($checksum))->validate(
            $this->getAccountNumberMock()
        );
    }
}
