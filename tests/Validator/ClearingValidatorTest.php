<?php

declare(strict_types=1);

namespace byrokrat\banking\Validator;

use byrokrat\banking\AccountNumber;

class ClearingValidatorTest extends \PHPUnit\Framework\TestCase
{
    use \Prophecy\PhpUnit\ProphecyTrait;

    public function createValidator()
    {
        return new ClearingValidator(
            [
                [1000, 1999],
                [3000, 3999]
            ]
        );
    }

    public function validProvider()
    {
        return [
            ['1000'],
            ['1999'],
            ['3022']
        ];
    }

    /**
     * @dataProvider validProvider
     */
    public function testValidClearing($clearing)
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getClearingNumber()->willReturn($clearing);

        $this->assertInstanceOf(
            Success::CLASS,
            $this->createValidator()->validate($number->reveal())
        );
    }

    public function invalidProvider()
    {
        return [
            ['2000'],
            ['2999'],
            ['5349']
        ];
    }

    /**
     * @dataProvider invalidProvider
     */
    public function testExceptionOnInvalidClearing($clearing)
    {
        $number = $this->prophesize(AccountNumber::CLASS);
        $number->getClearingNumber()->willReturn($clearing);

        $this->assertInstanceOf(
            Failure::CLASS,
            $this->createValidator()->validate($number->reveal())
        );
    }
}
