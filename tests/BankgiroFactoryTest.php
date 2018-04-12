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

    public function testExceptionOnInvalidStructure()
    {
        $this->expectException(InvalidAccountNumberException::CLASS);
        (new BankgiroFactory)->createAccount('580-56200');
    }

    public function testExceptionOnInvalidCheckDigit()
    {
        $this->expectException(InvalidAccountNumberException::CLASS);
        (new BankgiroFactory)->createAccount('58056200');
    }
}
