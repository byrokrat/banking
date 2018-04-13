<?php

declare(strict_types = 1);

namespace byrokrat\banking\Format\Build;

/**
 * This class has been auto-generated and should not be edited directly
 *
 * Generated in accordance with BGC specifications dated 2017-08-15.
 */
class SantanderFormatTest extends \PHPUnit\Framework\TestCase
{
    private function getAccount(): \byrokrat\banking\AccountNumber
    {
        return new \byrokrat\banking\UndefinedAccount("", "9460", "", "111112", "9");
    }

    public function testGetBankName()
    {
        $this->assertSame(
            \byrokrat\banking\BankNames::BANK_SANTANDER,
            (new SantanderFormat)->getBankName()
        );
    }

    public function testIsValidClearing()
    {
        $this->assertTrue(
            (new SantanderFormat)->isValidClearing(
                $this->getAccount()
            )
        );
    }

    public function testValidate()
    {
        $this->assertTrue(
            (new SantanderFormat)->validate($this->getAccount())->isValid()
        );
    }
}
