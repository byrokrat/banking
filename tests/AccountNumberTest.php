<?php

namespace byrokrat\banking;

class AccountNumberTest extends \PHPUnit_Framework_TestCase
{
    public function testGetBankName()
    {
        $this->assertSame(
            'bank',
            (new AccountNumber('bank', '', '', '', ''))->getBankName()
        );
    }

    public function testGetNumber()
    {
        $this->assertSame(
            '1234-5,7777777-1',
            (new AccountNumber('', '1234', '5', '7777777', '1'))->getNumber()
        );
        $this->assertSame(
            '1234,7777777-1',
            (new AccountNumber('', '1234', '', '7777777', '1'))->getNumber()
        );
        $this->assertSame(
            '1234-5,7777777-1',
            (string)new AccountNumber('', '1234', '5', '7777777', '1')
        );
    }

    public function testGet16()
    {
        $this->assertSame(
            '1234000077777771',
            (new AccountNumber('', '1234', '5', '7777777', '1'))->get16()
        );
    }
}
