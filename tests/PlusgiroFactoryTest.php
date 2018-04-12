<?php

declare(strict_types = 1);

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
            (new PlusgiroFactory)->createAccount('58056201')->getBankName()
        );
    }

    public function testCreatePlusgiroWithHyphen()
    {
        $this->assertSame(
            BankNames::BANK_PLUSGIRO,
            (new PlusgiroFactory)->createAccount('5805620-1')->getBankName()
        );
    }

    public function testExceptionOnInvalidStructure()
    {
        $this->expectException(InvalidAccountNumberException::CLASS);
        (new PlusgiroFactory)->createAccount('5805-6201');
    }

    public function testExceptionOnInvalidCheckDigit()
    {
        $this->expectException(InvalidAccountNumberException::CLASS);
        (new PlusgiroFactory)->createAccount('58056200');
    }
}
