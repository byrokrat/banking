<?php

namespace byrokrat\banking;

/**
 * @covers \byrokrat\banking\BankgiroFactory
 */
class BankgiroFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateBankgiroAccount()
    {
        $this->assertSame(
            BankNames::BANK_BANKGIRO,
            (new BankgiroFactory)->createAccount('58056201')->getBankName()
        );
    }
}
