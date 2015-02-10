<?php

namespace byrokrat\banking;

abstract class AccountNumberTestCase extends \PHPUnit_Framework_TestCase
{
    private static $formats;
    private static $accountFactory;

    public static function setUpBeforeClass()
    {
        if (!isset(self::$formats)) {
            self::$formats = (new Formats)->createFormats();
            self::$accountFactory = new AccountFactory(self::$formats);
        }
    }

    abstract public function getFormatId();

    abstract public function getBankIdentifier();

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

    public function validProvider()
    {
        return [[null, null, null, null, null]];
    }

    /**
     * @dataProvider validProvider
     */
    public function testValidNumber($number, $clearing, $clearingCheck, $serial, $check)
    {
        if ($number !== null) {
            $account = $this->buildAccount($number);
            $this->assertRawNumber($number, $account);
            $this->assertNumericalParts($account, $clearing, $clearingCheck, $serial, $check);
            $this->assertFormattedNumber($account);
            $this->assert16format($account);
        }
    }

    /**
     * @dataProvider validProvider
     */
    public function testCreationThroughAccountFactory($number)
    {
        if ($number !== null) {
            $this->assertSame(
                $this->getBankIdentifier(),
                self::$accountFactory->createAccount($number)->getBankName(),
                'Account must be of the correct class when created through AccountFactory'
            );
        }
    }

    protected function assertRawNumber($raw, AccountNumber $account)
    {
        $this->assertSame(
            $raw,
            $account->getRawNumber(),
            'The correct raw number should be returned'
        );
    }

    protected function assertNumericalParts(AccountNumber $account, $clearing, $clearingCheck, $serial, $check)
    {
        $this->assertRegExp(
            '/^\d{4}$/',
            $account->getClearingNumber(),
            "Clearing must be 4  digits in {$account->getRawNumber()}"
        );
        $this->assertSame(
            $clearing,
            $account->getClearingNumber(),
            'The correct clearing number must be parsed'
        );
        $this->assertRegExp(
            '/^\d?$/',
            $account->getClearingCheckDigit(),
            "Clearing check digit must be 1 or 0 digits in {$account->getRawNumber()}"
        );
        $this->assertSame(
            $clearingCheck,
            $account->getClearingCheckDigit(),
            'The correct clearing check digit must be parsed'
        );
        $this->assertRegExp(
            '/^\d{1,11}$/',
            $account->getSerialNumber(),
            "Serial number must consist of 1-11 digits in {$account->getRawNumber()}"
        );
        $this->assertSame(
            $serial,
            $account->getSerialNumber(),
            'The correct serial number must be parsed'
        );
        $this->assertRegExp(
            '/^\d$/',
            $account->getCheckDigit(),
            "Check digit must be 1 digit in {$account->getRawNumber()}"
        );
        $this->assertSame(
            $check,
            $account->getCheckDigit(),
            'The correct check digit must be parsed'
        );
    }

    protected function assertFormattedNumber(AccountNumber $account)
    {
        $formatted = $account->getNumber();
        $this->assertSame(
            $formatted,
            (string)$this->buildAccount($formatted),
            'Format must be able to parse the formatted account number'
        );
    }

    protected function assert16format(AccountNumber $account)
    {
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
            'Format must be able to parse to and from the 16 format'
        );
    }

    protected function buildAccount($number)
    {
        return self::$formats[$this->getFormatId()]->parse($number);
    }
}
