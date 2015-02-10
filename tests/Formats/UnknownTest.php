<?php

namespace byrokrat\banking;

/**
 * @covers \byrokrat\banking\BaseAccount
 */
class UnknownTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_UNKNOWN;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_UNKNOWN;
    }

    public function invalidStructureProvider()
    {
        return [
            ['123,1234567'],
            ['12345,1234567'],
            ['1234,123456'],
            ['1234,1234567890123'],
            ['1234123456'],
            ['00001234567'],
        ];
    }

    public function validProvider()
    {
        return [
            ['1000,1234567',     '1000', '', '123456', '7'],
            ['1000,123456789-0', '1000', '', '123456789', '0'],
            ['10001234567',      '1000', '', '123456', '7'],
            ['1000000001234567', '1000', '', '00000123456', '7'],
        ];
    }
}
