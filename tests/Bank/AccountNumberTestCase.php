<?php

namespace byrokrat\banking\Bank;

use byrokrat\banking\ParserFactory;
use byrokrat\banking\Resolver;

abstract class AccountNumberTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Parser[] Loaded parsers
     */
    private static $parsers;

    public static function setUpBeforeClass()
    {
        if (!isset(self::$parsers)) {
            self::$parsers = (new ParserFactory)->createParsers();
        }
    }

    /**
     * Get name of parser to test against
     */
    abstract public function getParserName();

    public function getParser()
    {
        return self::$parsers[$this->getParserName()];
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
     * NOTE: The maximum number of digits in number should be 16
     */
    abstract public function invalidStructureProvider();

    /**
     * @dataProvider invalidClearingProvider
     */
    public function testInvalidClearing($number)
    {
        $this->setExpectedException('byrokrat\banking\Exception\InvalidClearingNumberException');
        $this->buildAccount($number);
    }

    abstract public function invalidClearingProvider();

    /**
     * @dataProvider invalidCheckDigitProvider
     */
    public function testInvalidCheckDigit($number)
    {
        $this->setExpectedException('byrokrat\banking\Exception\InvalidCheckDigitException');
        $this->buildAccount($number);
    }

    abstract public function invalidCheckDigitProvider();

    /**
     * @covers byrokrat\banking\AbstractAccount
     * @dataProvider validProvider
     */
    public function testValidNumber($number)
    {
        $account = $this->buildAccount($number);

        $this->assertInstanceOf(
            'byrokrat\banking\AccountNumber',
            $account
        );

        $genericFormat = $account->getNumber();

        $this->assertSame(
            $genericFormat,
            (string)$this->buildAccount($genericFormat),
            'Parser must be able to parse the generic account format'
        );
    }

    /**
     * NOTE: Delimiter between clearing and clearing check digit should be optional
     */
    abstract public function validProvider();

    /**
     * @covers byrokrat\banking\AbstractAccount
     * @dataProvider validProvider
     */
    public function testParse16($number)
    {
        $account = $this->buildAccount($number);
        $format16 = $account->get16();

        $this->assertTrue(
            strlen($format16) == 16,
            'The length of the 16 format must be exactly 16 digits'
        );

        $this->assertSame(
            $format16,
            $this->buildAccount($format16)->get16(),
            'Parser must be able to parse to and from the 16 format'
        );
    }

    public function testGetBankName()
    {
        $this->assertSame(
            $this->getBankName(),
            $this->buildAccount($this->validProvider()[0][0])->getBankName()
        );
    }

    /**
     * Get expected bank name
     */
    abstract public function getBankName();
}
