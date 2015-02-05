<?php

namespace byrokrat\banking\Account;

use byrokrat\banking\ParserFactory;
use byrokrat\banking\AccountFactory;

abstract class AccountNumberTestCase extends \PHPUnit_Framework_TestCase
{
    private static $parsers;
    private static $accountFactory;

    public static function setUpBeforeClass()
    {
        if (!isset(self::$parsers)) {
            self::$parsers = (new ParserFactory)->createParsers();
            self::$accountFactory = new AccountFactory(self::$parsers);
        }
    }

    /**
     * Get id of format to test
     */
    abstract public function getFormatId();

    /**
     * Get name of class this case covers
     */
    abstract public function getClassName();

    /**
     * Get list of valid numbers to test
     */
    abstract public function validProvider();

    public function invalidStructureProvider()
    {
        return [[null]];
    }

    /**
     * @dataProvider invalidStructureProvider
     */
    public function testInvalidStructure($number)
    {
        if ($number !== null) {
            $this->setExpectedException('byrokrat\banking\Exception\InvalidStructureException');
            $this->buildAccount($number);
        }
    }

    public function invalidClearingProvider()
    {
        return [[null]];
    }

    /**
     * @dataProvider invalidClearingProvider
     */
    public function testInvalidClearing($number)
    {
        if ($number !== null) {
            $this->setExpectedException('byrokrat\banking\Exception\InvalidClearingNumberException');
            $this->buildAccount($number);
        }
    }

    public function invalidCheckDigitProvider()
    {
        return [[null]];
    }

    /**
     * @dataProvider invalidCheckDigitProvider
     */
    public function testInvalidCheckDigit($number)
    {
        if ($number !== null) {
            $this->setExpectedException('byrokrat\banking\Exception\InvalidCheckDigitException');
            $this->buildAccount($number);
        }
    }

    /**
     * @covers byrokrat\banking\Account\BaseAccount::__construct
     * @covers byrokrat\banking\Account\BaseAccount::getClearingNumber
     * @covers byrokrat\banking\Account\BaseAccount::getClearingCheckDigit
     * @covers byrokrat\banking\Account\BaseAccount::getSerialNumber
     * @covers byrokrat\banking\Account\BaseAccount::getCheckDigit
     * @dataProvider validProvider
     */
    public function testNumericalParts($number, $clearing, $clearingCheck, $serial, $check)
    {
        $account = $this->buildAccount($number);
        $this->assertRegExp(
            '/^\d{4}$/',
            $account->getClearingNumber(),
            "Clearing must be 4  digits, parsing: $number"
        );
        $this->assertSame(
            $clearing,
            $account->getClearingNumber(),
            'The correct clearing number must be parsed'
        );
        $this->assertRegExp(
            '/^\d?$/',
            $account->getClearingCheckDigit(),
            "Clearing check digit must be 1 or 0 digits, parsing: $number"
        );
        $this->assertSame(
            $clearingCheck,
            $account->getClearingCheckDigit(),
            'The correct clearing check digit must be parsed'
        );
        $this->assertRegExp(
            '/^\d{1,11}$/',
            $account->getSerialNumber(),
            "Serial number must consist of 1-11 digits, parsing: $number"
        );
        $this->assertSame(
            $serial,
            $account->getSerialNumber(),
            'The correct serial number must be parsed'
        );
        $this->assertRegExp(
            '/^\d$/',
            $account->getCheckDigit(),
            "Check digit must be 1 digit, parsing: $number"
        );
        $this->assertSame(
            $check,
            $account->getCheckDigit(),
            'The correct check digit must be parsed'
        );
    }

    /**
     * @covers byrokrat\banking\Account\BaseAccount::__toString
     * @covers byrokrat\banking\Account\BaseAccount::getNumber
     * @dataProvider validProvider
     */
    public function testFormattedNumber($number)
    {
        $account = $this->buildAccount($number);
        $formatted = $account->getNumber();

        $this->assertSame(
            $formatted,
            (string)$this->buildAccount($formatted),
            'Parser must be able to parse the formatted account number'
        );
    }

    /**
     * @covers byrokrat\banking\Account\BaseAccount::get16
     * @dataProvider validProvider
     */
    public function testParse16($number)
    {
        $account = $this->buildAccount($number);
        $format16 = $account->get16();

        $this->assertTrue(
            strlen($format16) == 16,
            "The length of the 16 format must be exactly 16 digits, found: $format16"
        );

        $this->assertTrue(
            ctype_digit($format16),
            "The 16 format must consist of only digits, found: $format16"
        );

        $this->assertSame(
            $format16,
            $this->buildAccount($format16)->get16(),
            'Parser must be able to parse to and from the 16 format'
        );
    }

    /**
     * @covers byrokrat\banking\Account\BaseAccount::getRawNumber
     * @dataProvider validProvider
     */
    public function testRawNumber($number)
    {
        $this->assertSame(
            $number,
            $this->buildAccount($number)->getRawNumber(),
            'The correct raw number should be returned'
        );
    }

    /**
     * @dataProvider validProvider
     */
    public function testCreationThroughAccountFactory($number)
    {
        $this->assertInstanceOf(
            $this->getClassName(),
            self::$accountFactory->createAccount($number),
            'Account must be of the correct class when created through AccountFactory'
        );
    }

    /**
     * @covers byrokrat\banking\Account\BaseAccount::getBankName
     */
    public function testBankName()
    {
        $account = $this->getMockBuilder($this->getClassName())
            ->disableOriginalConstructor()
            ->setMethods(null)
            ->getMock();

        $this->assertSame(
            $account->getBankName(),
            $this->buildAccount($this->validProvider()[0][0])->getBankName(),
            'The correct bank name should be returned'
        );
    }

    protected function buildAccount($number)
    {
        return self::$parsers[strtolower($this->getFormatId())]->parse($number);
    }
}
