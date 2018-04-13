<?php

declare(strict_types = 1);

namespace byrokrat\banking\Format\Build;

/**
 * This class has been auto-generated and should not be edited directly
 *
 * Generated in accordance with BGC specifications dated 2017-08-15.
 */
class BluestepFormatTest extends \PHPUnit\Framework\TestCase
{
    private function getAccount(): \byrokrat\banking\AccountNumber
    {
        return new \byrokrat\banking\UndefinedAccount("", "9680", "", "111112", "4");
    }

    public function testGetBankName()
    {
        $this->assertSame(
            \byrokrat\banking\BankNames::BANK_BLUESTEP,
            (new BluestepFormat)->getBankName()
        );
    }

    public function testIsValidClearing()
    {
        $this->assertTrue(
            (new BluestepFormat)->isValidClearing(
                $this->getAccount()
            )
        );
    }

    public function testValidate()
    {
        $this->assertTrue(
            (new BluestepFormat)->validate($this->getAccount())->isValid()
        );
    }
}
