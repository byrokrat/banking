Banking
=======

[![Packagist Version](https://img.shields.io/packagist/v/byrokrat/banking.svg?style=flat-square)](https://packagist.org/packages/byrokrat/banking)
[![Build Status](https://img.shields.io/travis/byrokrat/banking/master.svg?style=flat-square)](https://travis-ci.org/byrokrat/banking)
[![Quality Score](https://img.shields.io/scrutinizer/g/byrokrat/banking.svg?style=flat-square)](https://scrutinizer-ci.com/g/byrokrat/banking)
[![Scrutinizer Coverage](https://img.shields.io/scrutinizer/coverage/g/byrokrat/banking.svg?style=flat-square)](https://scrutinizer-ci.com/g/byrokrat/banking/?branch=master)
[![Dependency Status](https://img.shields.io/gemnasium/byrokrat/banking.svg?style=flat-square)](https://gemnasium.com/byrokrat/banking)

Data types for accounts in the swedish banking system, Handelsbanken, ICA-banken, Nordea, SEB, Skandiabanken, Swedbank, PlusGirot, Bankgirot among others

Installation
------------
```shell
composer require byrokrat/banking
```

Usage
-----
```php
use byrokrat\banking\AccountFactory;
use byrokrat\banking\BankNames;

$factory = new AccountFactory;
$account = $factory->createAccount('3300,1111111116');

echo $account->getBankName();                      // Nordea
$account->getBankName() == BankNames::BANK_NORDEA; // true
echo $account->getClearingNumber();                // 3300
echo $account->getSerialNumber();                  // 111111111
echo $account->getCheckDigit();                    // 6
echo $account->getNumber();                        // 3300,111 111 111-6
echo $account->get16();                            // 3300001111111116
```

See the list of [bank and format identifiers](/src/BankNames.php).

Api
---
Account numbers implement the [`AccountNumber`](/src/AccountNumber.php)
interface. AccountNumber defines the following api:

Signature               | Returns                 | Description
:---------------------- | :---------------------- | :------------------------------------------
getRawNumber()          | string                  | Get the raw number
getNumber()             | string                  | Get formatted number
__toString()            | string                  | Shorthand to getNumber
getClearingNumber()     | string (4 digits)       | Get clearing number
getClearingCheckDigit() | string (1 or 0 digits)  | Check digit of the clearing number
getSerialNumber()       | string (1 to 11 digits) | Get account serial number
getCheckDigit()         | string (1 digit)        | Get account check digit
get16()                 | string (16 digits)      | Generic 16 digit format
getBankName()           | string                  | Name of Bank this number belongs to

Format of the raw account number
--------------------------------
When processing a raw account number the following rules apply:

1. Spaces are ignored.
1. An optional `,` delimiter between clearing and serial numbers may be used.
1. An optional `-` delimiter may be used before check digits.

The following formats are all valid (and considered equal)

    14053542562
    1405,3542562
    1405,354256-2
    1405,354 256-2

### Clearing number check digits for Swedbank accounts

Swedbank account numbers with clearing numbers starting with `8` may specify a
fifth clearing number check digit. The clearing number check digit is optional,
but if present a `,` must be used to mark where the clearing number ends and the
serial number begins.

The following formats are valid (and equal)

    81050,744202466
    8105-0,744202466

Parsing Bankgiro and PlusGiro accounts
--------------------------------------
> **NOTE:** When parsing Bankgiro or PlusGiro account numbers without delimiters
> always whitelist the expected format before parsing.

The `-` delimiter is optional when parsing Bankgiro and PlusGiro account numbers.
When omitted it may not be possible determine if the raw number is indeed a Bankgiro
or PlusGiro account number: `5805-6201` is a valid Bankgiro number and `5805620-1`
is a valid PlusGiro number.

This issue is resolved by whitelisting the expected format prior to parsing.

```php
use byrokrat\banking\AccountFactory;
use byrokrat\banking\BankNames;

$factory = new AccountFactory;
$factory->whitelistFormats([BankNames::FORMAT_PLUSGIRO]);
$account = $factory->createAccount('58056201');
$account->getBankName() == BankNames::BANK_PLUSGIRO;      // true
```

```php
use byrokrat\banking\AccountFactory;
use byrokrat\banking\BankNames;

$factory = new AccountFactory;
$factory->whitelistFormats([BankNames::FORMAT_BANKGIRO]);
$account = $factory->createAccount('58056201');
$account->getBankName() == BankNames::BANK_BANKGIRO;      // true
```

Credits
-------
Banking is covered under the [WTFPL](http://www.wtfpl.net/)

@author Hannes Forsgård (hannes.forsgard@fripost.org)
