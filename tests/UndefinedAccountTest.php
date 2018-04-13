<?php

declare(strict_types = 1);

namespace byrokrat\banking;

class UndefinedAccountTest extends \PHPUnit\Framework\TestCase
{
    public function testSimpleGetters()
    {
        $account = new UndefinedAccount('raw', 'clear', 'clearCheck', 'serial', 'check');

        $this->assertSame('', $account->getBankName());
        $this->assertSame('raw', $account->getRawNumber());
        $this->assertSame('clear', $account->getClearingNumber());
        $this->assertSame('clearCheck', $account->getClearingCheckDigit());
        $this->assertSame('serial', $account->getSerialNumber());
        $this->assertSame('check', $account->getCheckDigit());
    }

    public function testGetNumber()
    {
        $this->assertSame(
            '1111-2,333 333 33-4',
            (new UndefinedAccount('', '1111', '2', '33333333', '4'))->getNumber()
        );

        $this->assertSame(
            '1111,333 333 33-4',
            (new UndefinedAccount('', '1111', '', '33333333', '4'))->getNumber()
        );
    }

    public function testGet16()
    {
        $this->assertSame(
            '1111000333333334',
            (new UndefinedAccount('', '1111', '2', '33333333', '4'))->get16()
        );
    }

    public function testEquals()
    {
        $account = new UndefinedAccount('', 'clear', 'clearCheck', 'serial', 'check');

        $this->assertFalse(
            $account->equals(new UndefinedAccount('', 'FAIL', 'clearCheck', 'serial', 'check')),
            'Accounts should not be equal as the clearing number differ'
        );

        $this->assertFalse(
            $account->equals(new UndefinedAccount('', 'clear', 'clearCheck', 'FAIL', 'check')),
            'Accounts should not be equal as the serial number differ'
        );

        $this->assertFalse(
            $account->equals(new UndefinedAccount('', 'clear', 'clearCheck', 'serial', 'FAIL')),
            'Accounts should not be equal as the check digit differ'
        );

        $this->assertFalse(
            $account->equals(new UndefinedAccount('', 'clear', 'FAIL', 'serial', 'check')),
            'Accounts should not be equal as the clearing check digit differ'
        );

        $this->assertTrue(
            $account->equals(new UndefinedAccount('', 'clear', '', 'serial', 'check')),
            'Accounts should be considered equal even though clearing checkdigit is missing'
        );

        $this->assertFalse(
            $account->equals(new UndefinedAccount('', 'clear', '', 'serial', 'check'), true),
            'Accounts should not be considered equal as clearing checkdigit is missing and strict mode is enabled'
        );
    }

    public function testEqualsWhenClearingCheckIsCero()
    {
        $this->assertFalse(
            (new UndefinedAccount('', '', '0', '', ''))->equals(
                new UndefinedAccount('', '', '', '', ''),
                true
            ),
            'Accounts should not be considered equal as clearing checkdigit differs'
        );
    }
}
