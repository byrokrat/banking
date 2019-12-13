<?php

declare(strict_types = 1);

namespace byrokrat\banking\Format\Build;

/**
 * This class has been auto-generated and should not be edited directly
 *
 * Generated in accordance with BGC specifications dated 2019-10-22.
 */
class Swedbank1FormatTest extends \PHPUnit\Framework\TestCase
{
    private function getAccount(): \byrokrat\banking\AccountNumber
    {
        return new \byrokrat\banking\UndefinedAccount("", "7000", "", "111111", "6");
    }

    public function testGetBankName()
    {
        $this->assertSame(
            \byrokrat\banking\BankNames::BANK_SWEDBANK,
            (new Swedbank1Format)->getBankName()
        );
    }

    public function testIsValidClearing()
    {
        $this->assertTrue(
            (new Swedbank1Format)->isValidClearing(
                $this->getAccount()
            )
        );
    }

    public function testValidate()
    {
        $this->assertTrue(
            (new Swedbank1Format)->validate($this->getAccount())->isValid()
        );
    }
}
