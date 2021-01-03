<?php

namespace byrokrat\banking;

use byrokrat\banking\Exception\InvalidAccountNumberException;

/**
 * Test account numbers from integrationtestdata.json
 */
class IntegrationTest extends \PHPUnit\Framework\TestCase
{
    public const TEST_DATA_SOURCE = __DIR__ . '/integrationtestdata.json';

    /**
     * @var AccountFactoryInterface
     */
    private static $accountFactory;

    public static function setUpBeforeClass(): void
    {
        self::$accountFactory = new AccountFactory();
    }

    private static function createAccount(string $raw): AccountNumber
    {
        return self::$accountFactory->createAccount($raw);
    }

    private static function getData(): array
    {
        return json_decode(file_get_contents(self::TEST_DATA_SOURCE), true);
    }

    public function invalidProvider(): \Generator
    {
        foreach (self::getData() as $item) {
            foreach ($item['invalid_numbers'] ?? [] as $number) {
                yield [$number['number'] ?? $number];
            }
        }
    }

    /**
     * @dataProvider invalidProvider
     */
    public function testInvalidNumber(string $raw): void
    {
        $this->expectException(InvalidAccountNumberException::CLASS);
        $this->createAccount($raw);
    }

    public function validProvider(): \Generator
    {
        foreach (self::getData() as $item) {
            $bank = constant("\byrokrat\banking\BankNames::{$item['bank_id']}");

            foreach ($item['valid_numbers'] as $number) {
                if (is_string($number)) {
                    $number = ['number' => $number, 'permutations' => []];
                }
                yield [$bank, $number['number'], $number['permutations']];
            }
        }
    }

    /**
     * @dataProvider validProvider
     */
    public function testValidNumber(string $bankId, string $raw, array $permutations): void
    {
        $account = $this->createAccount($raw);

        $this->assertSame(
            $bankId,
            $account->getBankName(),
            'Created account should contain the expected bank name'
        );

        $this->assertMatchesRegularExpression(
            '/^\d{4}$/',
            $account->getClearingNumber(),
            "Clearing must be 4 digits in $raw"
        );

        $this->assertMatchesRegularExpression(
            '/^\d?$/',
            $account->getClearingCheckDigit(),
            "Clearing check digit must be 1 or 0 digits in $raw"
        );

        $this->assertMatchesRegularExpression(
            '/^\d+$/',
            $account->getSerialNumber(),
            "Serial number must be numberic"
        );

        $this->assertMatchesRegularExpression(
            '/^\d$/',
            $account->getCheckDigit(),
            "Check digit must be 1 digit in $raw"
        );

        $this->assertTrue(
            $account->equals($this->createAccount($account->getNumber()), true),
            "The formatted account ($account) must be a valid permutation of $raw"
        );

        $this->assertMatchesRegularExpression(
            '/^\d{16}$/',
            $account->get16(),
            "The 16 format must consist of exactly 16 digits"
        );

        $this->assertTrue(
            $account->equals($this->createAccount($account->get16()), false),
            "The 16-format version {$account->get16()} must be a valid permutation of $raw"
        );

        foreach ($permutations as $permutation) {
            $this->assertTrue(
                $account->equals($this->createAccount($permutation), true),
                "Permutation ($permutation) should equal orignial number $raw"
            );
        }
    }
}
