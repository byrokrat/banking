<?php

declare(strict_types=1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\Exception\LogicException;

class Modulo11Test extends \PHPUnit\Framework\TestCase
{
    public function invalidStructureProvider()
    {
        return [
            ['y'],
            [''],
            ['X2'],
            ['123X'],
            ['1234.234']
        ];
    }

    /**
     * @dataProvider invalidStructureProvider
     */
    public function testInvalidStructure($number)
    {
        $this->expectException(LogicException::CLASS);
        (new Modulo11())->calculateCheckDigit($number);
    }

    public function testCalculateCheckDigit()
    {
        $modulo11 = new Modulo11();
        $this->assertSame('7', $modulo11->calculateCheckDigit('036532'));
        $this->assertSame('2', $modulo11->calculateCheckDigit('392844404'));
        $this->assertSame('9', $modulo11->calculateCheckDigit('013139139'));
        $this->assertSame('9', $modulo11->calculateCheckDigit('01313913911'));
        $this->assertSame('X', $modulo11->calculateCheckDigit('007007013'));
        $this->assertSame('0', $modulo11->calculateCheckDigit('036530'));
    }
}
