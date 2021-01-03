<?php

declare(strict_types=1);

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
            (new Bankgiro('', '', ''))->getBankName()
        );
    }

    public function testGetRawNumber()
    {
        $this->assertSame(
            'raw',
            (new Bankgiro('raw', '', ''))->getRawNumber()
        );
    }

    public function testGetClearingNumber()
    {
        $this->assertSame(
            '0000',
            (new Bankgiro('', '', ''))->getClearingNumber()
        );
    }

    public function testGetSerialNumber()
    {
        $this->assertSame(
            '11',
            (new Bankgiro('', '11', ''))->getSerialNumber()
        );
    }

    public function testGetNumber()
    {
        $this->assertSame(
            '123-4567',
            (new Bankgiro('', '123456', '7'))->getNumber()
        );

        $this->assertSame(
            '1234-5678',
            (new Bankgiro('', '1234567', '8'))->getNumber()
        );
    }

    public function testPrettyprint()
    {
        $this->assertSame(
            '123-4567',
            (new Bankgiro('', '123456', '7'))->prettyprint()
        );
    }
}
