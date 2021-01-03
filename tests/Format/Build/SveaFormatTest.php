<?php

declare(strict_types=1);

namespace byrokrat\banking\Format\Build;

/**
 * This class has been auto-generated and should not be edited directly
 *
 * Generated in accordance with BGC specifications dated 2020-04-15.
 */
class SveaFormatTest extends \PHPUnit\Framework\TestCase
{
    private function getAccount(): \byrokrat\banking\AccountNumber
    {
        return new \byrokrat\banking\UndefinedAccount("", "9660", "", "111113", "0");
    }

    public function testGetBankName()
    {
        $this->assertSame(
            \byrokrat\banking\BankNames::BANK_SVEA,
            (new SveaFormat())->getBankName()
        );
    }

    public function testIsValidClearing()
    {
        $this->assertTrue(
            (new SveaFormat())->isValidClearing(
                $this->getAccount()
            )
        );
    }

    public function testValidate()
    {
        $this->assertTrue(
            (new SveaFormat())->validate($this->getAccount())->isValid()
        );
    }
}
