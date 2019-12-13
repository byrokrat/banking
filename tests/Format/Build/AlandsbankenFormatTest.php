<?php

declare(strict_types = 1);

namespace byrokrat\banking\Format\Build;

/**
 * This class has been auto-generated and should not be edited directly
 *
 * Generated in accordance with BGC specifications dated 2019-10-22.
 */
class AlandsbankenFormatTest extends \PHPUnit\Framework\TestCase
{
    private function getAccount(): \byrokrat\banking\AccountNumber
    {
        return new \byrokrat\banking\UndefinedAccount("", "2300", "", "111113", "3");
    }

    public function testGetBankName()
    {
        $this->assertSame(
            \byrokrat\banking\BankNames::BANK_ALANDSBANKEN,
            (new AlandsbankenFormat)->getBankName()
        );
    }

    public function testIsValidClearing()
    {
        $this->assertTrue(
            (new AlandsbankenFormat)->isValidClearing(
                $this->getAccount()
            )
        );
    }

    public function testValidate()
    {
        $this->assertTrue(
            (new AlandsbankenFormat)->validate($this->getAccount())->isValid()
        );
    }
}
