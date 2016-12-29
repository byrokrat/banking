<?php

namespace byrokrat\banking\Format;

use byrokrat\banking\FormatFactory;
use byrokrat\banking\UnknownFormat;
use byrokrat\banking\BankNames;
use byrokrat\banking\AccountFactory;
use byrokrat\banking\AccountNumber;

/**
 * Test account numbers from testdata.json
 */
class FormatsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @const Default account data
     */
    private static $defaultAccountData = [
        "account_number" => "",
        "parts" => [
            "clearing" => "0000",
            "clearing_check_digit" => "",
            "serial" => "",
            "check_digit" => ""
        ],
        "permutations" => [],
        "custom_assertions" => []
    ];

    /**
     * @var \byrokrat\banking\Format[]
     */
    private static $formats;

    /**
     * @var array Parsed from testdata.json in getTestData()
     */
    private static $testData;

    /**
     * Get the set of supported account formats
     */
    public static function getAccountFormats()
    {
        if (!isset(self::$formats)) {
            self::$formats = (new FormatFactory)->createFormats();
        }

        return self::$formats;
    }

    /**
     * Get data from testdata.json
     */
    public static function getTestData()
    {
        if (!isset(self::$testData)) {
            self::$testData = json_decode(file_get_contents(__DIR__ . '/testdata.json'), true);
        }

        return self::$testData;
    }

    /**
     * Generate invalid account number data
     */
    public function invalidAccountNumberProvider()
    {
        foreach (self::getTestData() as $item) {
            if (isset($item['invalid_account_numbers'])) {
                foreach ($item['invalid_account_numbers'] as $accountData) {
                    yield [
                        constant("\byrokrat\banking\BankNames::{$accountData['format_id']}"),
                        $accountData['account_number'],
                        "\byrokrat\banking\Exception\\{$accountData['expected_exception']}"
                    ];
                }
            }
        }
    }

    /**
     * Generate valid account number data
     */
    public function validAccountNumberProvider()
    {
        foreach (self::getTestData() as $item) {
            foreach ($item['valid_account_numbers'] as $accountData) {
                $accountData = array_replace_recursive(self::$defaultAccountData, $accountData);
                yield [
                    constant("\byrokrat\banking\BankNames::{$item['bank_id']}"),
                    isset($item['blacklist']) ? [constant("\byrokrat\banking\BankNames::{$item['blacklist']}")] : [],
                    $accountData['account_number'],
                    $accountData['parts']['clearing'],
                    $accountData['parts']['clearing_check_digit'],
                    $accountData['parts']['serial'],
                    $accountData['parts']['check_digit'],
                    $accountData['permutations'],
                    $accountData['custom_assertions']
                ];
            }
        }
    }

    /**
     * @dataProvider invalidAccountNumberProvider
     */
    public function testInvalidAccountNumber($formatId, $number, $expectedException)
    {
        $this->setExpectedException($expectedException);
        $format = $formatId == BankNames::FORMAT_UNKNOWN ? new UnknownFormat : self::getAccountFormats()[$formatId];
        $format->parse($number);
    }

    /**
     * @dataProvider validAccountNumberProvider
     */
    public function testValidAccountNumber($bankId, $blacklist, $number, $clear, $clearCheck, $serial, $check, array $permutations, array $custom)
    {
        $accountFactory = new AccountFactory(self::getAccountFormats());
        $accountFactory->blacklistFormats($blacklist);

        $account = $accountFactory->createAccount($number);

        $this->assertSame(
            $bankId,
            $account->getBankName(),
            'Created account should contain the expected bank name'
        );

        $this->assertSame(
            $number,
            $account->getRawNumber(),
            'The correct raw number should be returned by getRawNumber()'
        );

        $this->assertRegExp(
            '/^\d{4}$/',
            $account->getClearingNumber(),
            "Clearing must be 4  digits in {$account->getRawNumber()}"
        );

        $this->assertSame(
            $clear,
            $account->getClearingNumber(),
            'The correct clearing number must be parsed'
        );

        $this->assertRegExp(
            '/^\d?$/',
            $account->getClearingCheckDigit(),
            "Clearing check digit must be 1 or 0 digits in {$account->getRawNumber()}"
        );

        $this->assertSame(
            $clearCheck,
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

        $this->assertTrue(
            $account->equals($accountFactory->createAccount($account->getNumber()), true),
            'The formatted version of account must be a parseable permutation'
        );

        $this->assertRegExp(
            '/^\d{16}$/',
            $account->get16(),
            "The 16 format must consist of exactly 16 digits"
        );

        $this->assertTrue(
            $account->equals($accountFactory->createAccount($account->get16()), false),
            'The 16-format version of account must be a parseable permutation'
        );

        foreach ($permutations as $permutation) {
            $this->assertTrue(
                $account->equals($accountFactory->createAccount($permutation), true),
                'Permutation should equal orignial number'
            );
        }

        foreach ($custom as $assertion) {
            $test = eval('return function ($account) {'.$assertion['code'].'};');
            $test = $test->bindTo($this);
            $test($account);
        }
    }
}
