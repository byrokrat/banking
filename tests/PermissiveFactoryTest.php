<?php

declare(strict_types = 1);

namespace byrokrat\banking;

use byrokrat\banking\Exception\InvalidAccountNumberException;

/**
 * @covers \byrokrat\banking\PermissiveFactory
 */
class PermissiveFactoryTest extends \PHPUnit\Framework\TestCase
{
    public function testExceptionOnInvalidNumber()
    {
        $this->expectException(InvalidAccountNumberException::CLASS);
        (new PermissiveFactory)->createAccount('foo');
    }

    public function testSimpleNumber()
    {
        $this->assertEquals(
            new UndefinedAccount('4444511112', '4444', '', '51111', '2'),
            (new PermissiveFactory)->createAccount('4444511112')
        );
    }

    public function testClearingNumberSeparator()
    {
        $this->assertEquals(
            new UndefinedAccount('44445,11112', '4444', '5', '1111', '2'),
            (new PermissiveFactory)->createAccount('44445,11112')
        );
    }

    public function testIgnoreInvalidEarlyClearingNumberSeparator()
    {
        $this->assertEquals(
            new UndefinedAccount('444,4511112', '4444', '', '51111', '2'),
            (new PermissiveFactory)->createAccount('444,4511112')
        );
    }

    public function testIgnoreInvalidLateClearingNumberSeparator()
    {
        $this->assertEquals(
            new UndefinedAccount('444451,1112', '4444', '', '51111', '2'),
            (new PermissiveFactory)->createAccount('444451,1112')
        );
    }

    public function testIgnoreSpacesHyphensAndDots()
    {
        $this->assertEquals(
            new UndefinedAccount('4444-5,11 1.1-2', '4444', '5', '1111', '2'),
            (new PermissiveFactory)->createAccount('4444-5,11 1.1-2')
        );
    }
}
