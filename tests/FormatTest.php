<?php

namespace byrokrat\banking;

/**
 * @covers \byrokrat\banking\Format
 */
class FormatTest extends \PHPUnit_Framework_TestCase
{
    public function testInvalidStructure()
    {
        $this->setExpectedException('byrokrat\banking\Exception\InvalidStructureException');
        (new Format('bank', '/foo/', '', []))->parse('bar');
    }

    public function testInvalidRegexp()
    {
        $this->setExpectedException('byrokrat\banking\Exception\LogicException');
        (new Format('bank', '/foo/', '', []))->parse('foo');
    }

    public function testCreateAccountNumber()
    {
        $customValidator = $this->getMock('byrokrat\banking\Validator');
        $customValidator->expects($this->once())->method('validate');

        $classname = 'byrokrat\banking\BaseAccount';
        $this->assertInstanceOf(
            $classname,
            (new Format('bank', '/^()()()()$/', $classname, [$customValidator]))->parse('')
        );
    }
}
