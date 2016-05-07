<?php

namespace byrokrat\banking;

/**
 * @covers \byrokrat\banking\PlusgiroFactory
 */
class PlusgiroFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateBankgiroAccount()
    {
        $this->assertSame(
            BankNames::BANK_PLUSGIRO,
            (new PlusgiroFactory)->createAccount('58056201')->getBankName()
        );
    }
}
