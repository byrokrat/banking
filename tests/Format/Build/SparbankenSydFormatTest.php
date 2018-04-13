<?php

declare(strict_types = 1);

namespace byrokrat\banking\Format\Build;

/**
 * This class has been auto-generated and should not be edited directly
 *
 * Generated in accordance with BGC specifications dated 2017-08-15.
 */
class SparbankenSydFormatTest extends \PHPUnit\Framework\TestCase
{
    private function getAccount(): \byrokrat\banking\AccountNumber
    {
        return new \byrokrat\banking\UndefinedAccount("", "9570", "", "123456789", "7");
    }

    public function testGetBankName()
    {
        $this->assertSame(
            \byrokrat\banking\BankNames::BANK_SPARBANKEN_SYD,
            (new SparbankenSydFormat)->getBankName()
        );
    }

    public function testIsValidClearing()
    {
        $this->assertTrue(
            (new SparbankenSydFormat)->isValidClearing(
                $this->getAccount()
            )
        );
    }

    public function testValidate()
    {
        $this->assertTrue(
            (new SparbankenSydFormat)->validate($this->getAccount())->isValid()
        );
    }
}
