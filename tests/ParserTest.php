<?php

namespace byrokrat\banking;

/**
 * @covers \byrokrat\banking\Parser
 */
class ParserTest extends \PHPUnit_Framework_TestCase
{
    public function testInvalidStructure()
    {
        $this->setExpectedException('byrokrat\banking\Exception\InvalidStructureException');
        (new Parser('/foo/', '', []))->parse('bar');
    }

    public function testInvalidRegexp()
    {
        $this->setExpectedException('byrokrat\banking\Exception\LogicException');
        (new Parser('/foo/', '', []))->parse('foo');
    }

    public function testCreateAccountNumber()
    {
        $customValidator = $this->getMock('byrokrat\banking\Validator');
        $customValidator->expects($this->once())->method('validate');

        $classname = 'byrokrat\banking\Account\Unknown';
        $this->assertInstanceOf(
            $classname,
            (new Parser('/^()()()()$/', $classname, [$customValidator]))->parse('')
        );
    }
}
