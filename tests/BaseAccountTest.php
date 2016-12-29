<?php

namespace byrokrat\banking;

class BaseAccountTest extends \PHPUnit_Framework_TestCase
{
    public function testSimpleGetters()
    {
        $account = new BaseAccount('bank', 'raw', 'clear', 'clearCheck', 'serial', 'check');

        $this->assertSame(
            'bank',
            $account->getBankName()
        );

        $this->assertSame(
            'raw',
            $account->getRawNumber()
        );

        $this->assertSame(
            'clear',
            $account->getClearingNumber()
        );

        $this->assertSame(
            'clearCheck',
            $account->getClearingCheckDigit()
        );

        $this->assertSame(
            'serial',
            $account->getSerialNumber()
        );

        $this->assertSame(
            'check',
            $account->getCheckDigit()
        );
    }

    public function testGetNumber()
    {
        $this->assertSame(
            '1111-2,333 333 33-4',
            (new BaseAccount('', '', '1111', '2', '33333333', '4'))->getNumber()
        );

        $this->assertSame(
            '1111,333 333 33-4',
            (new BaseAccount('', '', '1111', '', '33333333', '4'))->getNumber()
        );
    }

    public function testGet16()
    {
        $this->assertSame(
            '1111000333333334',
            (new BaseAccount('', '', '1111', '2', '33333333', '4'))->get16()
        );
    }

    public function testEquals()
    {
        $account = new BaseAccount('bank', 'raw', 'clear', 'clearCheck', 'serial', 'check');

        $this->assertTrue(
            $account->equals(new BaseAccount('bank', '', 'clear', 'clearCheck', 'serial', 'check')),
            'Accounts should be considered equal as raw does not count'
        );

        $this->assertFalse(
            $account->equals(new BaseAccount('FAIL', 'raw', 'clear', 'clearCheck', 'serial', 'check')),
            'Accounts should not be equal as the bank name differ'
        );

        $this->assertFalse(
            $account->equals(new BaseAccount('bank', 'raw', 'FAIL', 'clearCheck', 'serial', 'check')),
            'Accounts should not be equal as the clearing number differ'
        );

        $this->assertFalse(
            $account->equals(new BaseAccount('bank', 'raw', 'clear', 'clearCheck', 'FAIL', 'check')),
            'Accounts should not be equal as the serial number differ'
        );

        $this->assertFalse(
            $account->equals(new BaseAccount('bank', 'raw', 'clear', 'clearCheck', 'serial', 'FAIL')),
            'Accounts should not be equal as the check digit differ'
        );

        $this->assertFalse(
            $account->equals(new BaseAccount('bank', 'raw', 'clear', 'FAIL', 'serial', 'check')),
            'Accounts should not be equal as the clearing check digit differ'
        );

        $this->assertTrue(
            $account->equals(new BaseAccount('bank', 'raw', 'clear', '', 'serial', 'check')),
            'Accounts should be considered equal even though clearing checkdigit is missing'
        );

        $this->assertFalse(
            $account->equals(new BaseAccount('bank', 'raw', 'clear', '', 'serial', 'check'), true),
            'Accounts should not be considered equal as clearing checkdigit is missing and strict mode is enabled'
        );
    }
}
