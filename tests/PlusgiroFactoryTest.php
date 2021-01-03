<?php

declare(strict_types=1);

namespace byrokrat\banking;

use byrokrat\banking\Exception\InvalidAccountNumberException;

/**
 * @covers \byrokrat\banking\PlusgiroFactory
 */
class PlusgiroFactoryTest extends \PHPUnit\Framework\TestCase
{
    public function testCreatePlusgiro()
    {
        $this->assertSame(
            BankNames::BANK_PLUSGIRO,
            (new PlusgiroFactory())->createAccount('58056201')->getBankName()
        );
    }

    public function testCreatePlusgiroWithHyphen()
    {
        $this->assertSame(
            BankNames::BANK_PLUSGIRO,
            (new PlusgiroFactory())->createAccount('5805620-1')->getBankName()
        );
    }

    public function testLeftTrimZeros()
    {
        $this->assertSame(
            BankNames::BANK_PLUSGIRO,
            (new PlusgiroFactory())->createAccount('0000000058056201')->getBankName()
        );
    }

    public function invalidStructureProvider()
    {
        return [
            ['5805-6201'],
            ['-1'],
            ['-12'],
            ['1-'],
            ['1'],
            ['1-12'],
            ['12345678-1'],
            ['1234567-12'],
            ['234,9048-0'],
        ];
    }

    /**
     * @dataProvider invalidStructureProvider
     */
    public function testExceptionOnInvalidStructure(string $raw)
    {
        $this->expectException(InvalidAccountNumberException::CLASS);
        (new PlusgiroFactory())->createAccount($raw);
    }

    public function testExceptionOnInvalidCheckDigit()
    {
        $this->expectException(InvalidAccountNumberException::CLASS);
        (new PlusgiroFactory())->createAccount('58056200');
    }
}
