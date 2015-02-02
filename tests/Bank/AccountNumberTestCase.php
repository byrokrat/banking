<?php

namespace byrokrat\banking\Bank;

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
     * Get name of parser to test against
     */
    abstract public function getParserName();

    /**
     * Get name of class this case covers
     */
    abstract public function getClassName();

    /**
     * NOTE: The maximum number of digits in number should be 16
     */
    abstract public function invalidStructureProvider();

    abstract public function invalidClearingProvider();

    abstract public function invalidCheckDigitProvider();

    /**
     * NOTE: Delimiters should be optional
     */
    abstract public function validProvider();

    public function getParser()
    {
        return self::$parsers[strtolower($this->getParserName())];
    }

    public function buildAccount($number)
    {
        return $this->getParser()->parse($number);
    }

    /**
     * @dataProvider invalidStructureProvider
     */
    public function testInvalidStructure($number)
    {
        $this->setExpectedException('byrokrat\banking\Exception\InvalidStructureException');
        $this->buildAccount($number);
    }

    /**
     * @dataProvider invalidClearingProvider
     */
    public function testInvalidClearing($number)
    {
        $this->setExpectedException('byrokrat\banking\Exception\InvalidClearingNumberException');
        $this->buildAccount($number);
    }

    /**
     * @dataProvider invalidCheckDigitProvider
     */
    public function testInvalidCheckDigit($number)
    {
        $this->setExpectedException('byrokrat\banking\Exception\InvalidCheckDigitException');
        $this->buildAccount($number);
    }

    /**
     * @covers byrokrat\banking\AbstractAccount::__construct
     * @covers byrokrat\banking\AbstractAccount::__toString
     * @covers byrokrat\banking\AbstractAccount::getNumber
     * @dataProvider validProvider
     */
    public function testValidNumber($number)
    {
        $account = $this->buildAccount($number);

        $this->assertInstanceOf(
            'byrokrat\banking\AccountNumber',
            $account,
            'Account must be an instance of AccountNumber'
        );

        $genericFormat = $account->getNumber();

        $this->assertSame(
            $genericFormat,
            (string)$this->buildAccount($genericFormat),
            'Parser must be able to parse the generic account format'
        );
    }

    /**
     * @covers byrokrat\banking\AbstractAccount::get16
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
     * @covers byrokrat\banking\AbstractAccount::getRawNumber
     * @dataProvider validProvider
     */
    public function testGetRawNumber($number)
    {
        $this->assertSame(
            $number,
            $this->buildAccount($number)->getRawNumber(),
            'The correct raw number should be returned'
        );
    }

    /**
     * @covers byrokrat\banking\AbstractAccount::getClearingNumber
     * @covers byrokrat\banking\AbstractAccount::getClearingCheckDigit
     * @covers byrokrat\banking\AbstractAccount::getSerialNumber
     * @covers byrokrat\banking\AbstractAccount::getCheckDigit
     * @dataProvider validProvider
     */
    public function testNumericParts($number)
    {
        $account = $this->buildAccount($number);

        $this->assertRegExp(
            '/^\d{4}$/',
            $account->getClearingNumber(),
            "Clearing must be 4  digits, parsing: $number"
        );
        $this->assertRegExp(
            '/^\d?$/',
            $account->getClearingCheckDigit(),
            "Clearing check digit must be 1 or 0 digits, parsing: $number"
        );
        $this->assertRegExp(
            '/^\d{1,11}$/',
            $account->getSerialNumber(),
            "Serial number must consist of 1-11 digits, parsing: $number"
        );
        $this->assertRegExp(
            '/^\d$/',
            $account->getCheckDigit(),
            "Check digit must be 1 digit, parsing: $number"
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
     * @covers byrokrat\banking\AbstractAccount::getBankName
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
}
