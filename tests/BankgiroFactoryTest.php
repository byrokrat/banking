<?php

declare(strict_types = 1);

namespace byrokrat\banking;

use byrokrat\banking\Exception\InvalidAccountNumberException;

/**
 * @covers \byrokrat\banking\BankgiroFactory
 */
class BankgiroFactoryTest extends \PHPUnit\Framework\TestCase
{
    public function testCreateBankgiro()
    {
        $this->assertSame(
            BankNames::BANK_BANKGIRO,
            (new BankgiroFactory)->createAccount('58056201')->getBankName()
        );
    }

    public function testCreateBankgiroWithHyphen()
    {
        $this->assertSame(
            BankNames::BANK_BANKGIRO,
            (new BankgiroFactory)->createAccount('5805-6201')->getBankName()
        );
    }

    public function testParseSearialNumber()
    {
        $this->assertSame(
            '5805620',
            (new BankgiroFactory)->createAccount('5805-6201')->getSerialNumber()
        );
    }

    public function invalidStructureProvider()
    {
        return [
            ['580-56200'],
            ['-1234'],
            ['1-1234'],
            ['12-1234'],
            ['12345-1234'],
            ['123'],
            ['123-'],
            ['123-1'],
            ['123-12'],
            ['123-123'],
            ['123-12345'],
            ['1234,5805-6200'],
            ['00000000011114444'],
        ];
    }

    /**
     * @dataProvider invalidStructureProvider
     */
    public function testExceptionOnInvalidStructure(string $raw)
    {
        $this->expectException(InvalidAccountNumberException::CLASS);
        (new BankgiroFactory)->createAccount($raw);
    }

    public function testExceptionOnInvalidCheckDigit()
    {
        $this->expectException(InvalidAccountNumberException::CLASS);
        (new BankgiroFactory)->createAccount('58056200');
    }
}
