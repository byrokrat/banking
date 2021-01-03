<?php

declare(strict_types=1);

namespace byrokrat\banking;

use byrokrat\banking\Exception\InvalidAccountNumberException;

/**
 * @covers \byrokrat\banking\StrictFactory
 */
class StrictFactoryTest extends \PHPUnit\Framework\TestCase
{
    public function testExceptionOnInvalidNumber()
    {
        $this->expectException(InvalidAccountNumberException::CLASS);
        (new StrictFactory())->createAccount('4444-5,11 1.1-2');
    }

    public function testSimpleNumber()
    {
        $this->assertEquals(
            new UndefinedAccount('4444511112', '4444', '', '51111', '2'),
            (new StrictFactory())->createAccount('4444511112')
        );
    }

    public function testClearingNumberSeparator()
    {
        $this->assertEquals(
            new UndefinedAccount('4444,511112', '4444', '', '51111', '2'),
            (new StrictFactory())->createAccount('4444,511112')
        );
    }

    public function testClearingNumberCheckDigitSeparator()
    {
        $this->assertEquals(
            new UndefinedAccount('44445,11112', '4444', '5', '1111', '2'),
            (new StrictFactory())->createAccount('44445,11112')
        );
    }

    public function testExceptionOnInvalidEarlyClearingNumberSeparator()
    {
        $this->expectException(InvalidAccountNumberException::CLASS);
        (new StrictFactory())->createAccount('444,4511112');
    }

    public function testExceptionOnInvalidLateClearingNumberSeparator()
    {
        $this->expectException(InvalidAccountNumberException::CLASS);
        (new StrictFactory())->createAccount('444451,1112');
    }
}
