<?php

namespace byrokrat\banking;

/**
 * @covers \byrokrat\banking\Format
 */
class FormatTest extends \PHPUnit\Framework\TestCase
{
    public function testInvalidStructure()
    {
        $this->expectException('byrokrat\banking\Exception\InvalidStructureException');
        (new Format('bank', '/foo/', '', []))->parse('bar');
    }

    public function testInvalidRegexp()
    {
        $this->expectException('byrokrat\banking\Exception\LogicException');
        (new Format('bank', '/foo/', '', []))->parse('foo');
    }

    public function testCreateAccountNumber()
    {
        $customValidator = $this->getMockBuilder('byrokrat\banking\Validator')->getMock();
        $customValidator->expects($this->once())->method('validate');

        $classname = 'byrokrat\banking\BaseAccount';
        $this->assertInstanceOf(
            $classname,
            (new Format('bank', '/^()()()()$/', $classname, [$customValidator]))->parse('')
        );
    }
}
