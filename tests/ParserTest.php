<?php

namespace byrokrat\banking;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    public function testInvalidStructure()
    {
        $this->setExpectedException('byrokrat\banking\Exception\InvalidStructureException');
        (new Parser('', '/foo/', [], []))->parse('bar');
    }

    public function testInvalidRegexp()
    {
        $this->setExpectedException('byrokrat\banking\Exception\LogicException');
        (new Parser('', '/foo/', [], []))->parse('foo');
    }

    public function invalidClearingProvider()
    {
        return [
            [[1000, 2000], '3000'],
            [[1000, 2000], '0999'],
            [[1000, 2000], '2001'],
        ];
    }

    /**
     * @dataProvider invalidClearingProvider
     */
    public function testInvalidClearing($range, $number)
    {
        $this->setExpectedException('byrokrat\banking\Exception\InvalidClearingNumberException');
        (new Parser('', '/^(\d{4})()()()$/', [$range], []))->parse($number);
    }

    public function testCreateAccountNumber()
    {
        $validator = $this->getMock('byrokrat\banking\Validator\Validator');
        $validator->expects($this->once())->method('validate');
        $this->assertInstanceOf(
            'byrokrat\banking\AccountNumber',
            (new Parser('', '/^(\d{4})()()()$/', [[1000, 2000]], [$validator]))->parse('1000')
        );
    }
}
