<?php

declare(strict_types = 1);

namespace byrokrat\banking;

/**
 * @covers \byrokrat\banking\Bankgiro
 */
class BankgiroTest extends \PHPUnit\Framework\TestCase
{
    public function testBankName()
    {
        $this->assertSame(
            BankNames::BANK_BANKGIRO,
            (new Bankgiro('', ''))->getBankName()
        );
    }

    public function testGetClearingNumber()
    {
        $this->assertSame(
            '0000',
            (new Bankgiro('', ''))->getClearingNumber()
        );
    }

    public function testGetSerialNumber()
    {
        $this->assertSame(
            '11',
            (new Bankgiro('11', ''))->getSerialNumber()
        );
    }

    public function testGetNumberSevenDigits()
    {
        $this->assertSame(
            '123-4567',
            (new Bankgiro('123456', '7'))->getNumber()
        );
    }

    public function testGetNumberEightDigits()
    {
        $this->assertSame(
            '1234-5678',
            (new Bankgiro('1234567', '8'))->getNumber()
        );
    }
}
