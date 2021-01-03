<?php

declare(strict_types=1);

namespace byrokrat\banking\Format\Build;

/**
 * This class has been auto-generated and should not be edited directly
 *
 * Generated in accordance with BGC specifications dated 2020-04-15.
 */
class Danske1FormatTest extends \PHPUnit\Framework\TestCase
{
    private function getAccount(): \byrokrat\banking\AccountNumber
    {
        return new \byrokrat\banking\UndefinedAccount("", "1200", "", "111112", "6");
    }

    public function testGetBankName()
    {
        $this->assertSame(
            \byrokrat\banking\BankNames::BANK_DANSKE,
            (new Danske1Format())->getBankName()
        );
    }

    public function testIsValidClearing()
    {
        $this->assertTrue(
            (new Danske1Format())->isValidClearing(
                $this->getAccount()
            )
        );
    }

    public function testValidate()
    {
        $this->assertTrue(
            (new Danske1Format())->validate($this->getAccount())->isValid()
        );
    }
}
