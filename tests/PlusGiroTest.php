<?php

declare(strict_types = 1);

namespace byrokrat\banking;

/**
 * @covers \byrokrat\banking\PlusGiro
 */
class PlusGiroTest extends \PHPUnit\Framework\TestCase
{
    public function testBankName()
    {
        $this->assertSame(
            BankNames::BANK_PLUSGIRO,
            (new PlusGiro('', '', ''))->getBankName()
        );
    }

    public function testGetRawNumber()
    {
        $this->assertSame(
            'raw',
            (new PlusGiro('raw', '', ''))->getRawNumber()
        );
    }

    public function testGetClearingNumber()
    {
        $this->assertSame(
            '0000',
            (new PlusGiro('', '', ''))->getClearingNumber()
        );
    }

    public function testGetSerialNumber()
    {
        $this->assertSame(
            '11',
            (new PlusGiro('', '11', ''))->getSerialNumber()
        );
    }

    public function testGetNumber()
    {
        $this->assertSame(
            '123456-7',
            (new PlusGiro('', '123456', '7'))->getNumber()
        );
    }
}
