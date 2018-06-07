<?php

declare(strict_types = 1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\Exception\LogicException;

class Modulo10Test extends \PHPUnit\Framework\TestCase
{
    public function invalidStructureProvider()
    {
        return [
            ['y'],
            [''],
            ['12.12']
        ];
    }

    /**
     * @dataProvider invalidStructureProvider
     */
    public function testInvalidStructure($number)
    {
        $this->expectException(LogicException::CLASS);
        (new Modulo10)->calculateCheckDigit($number);
    }

    public function testCalculateCheckDigit()
    {
        $modulo10 = new Modulo10;
        $this->assertSame('1', $modulo10->calculateCheckDigit('5555555'));
        $this->assertSame('6', $modulo10->calculateCheckDigit('991234'));
        $this->assertSame('7', $modulo10->calculateCheckDigit('987654321'));
        $this->assertSame('6', $modulo10->calculateCheckDigit('4992739871'));
    }
}
