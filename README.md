# Banking

[![Packagist Version](https://img.shields.io/packagist/v/byrokrat/banking.svg?style=flat-square)](https://packagist.org/packages/byrokrat/banking)
[![Build Status](https://img.shields.io/travis/byrokrat/banking/master.svg?style=flat-square)](https://travis-ci.org/byrokrat/banking)
[![Quality Score](https://img.shields.io/scrutinizer/g/byrokrat/banking.svg?style=flat-square)](https://scrutinizer-ci.com/g/byrokrat/banking)
[![Scrutinizer Coverage](https://img.shields.io/scrutinizer/coverage/g/byrokrat/banking.svg?style=flat-square)](https://scrutinizer-ci.com/g/byrokrat/banking/?branch=master)
[![Dependency Status](https://img.shields.io/gemnasium/byrokrat/banking.svg?style=flat-square)](https://gemnasium.com/byrokrat/banking)

Data types for accounts in the swedish banking system, Handelsbanken, ICA-banken, Nordea, SEB, Skandiabanken, Swedbank, PlusGirot, Bankgirot among others.

Understands account number formats as released by BGC [2016-10-31](https://www.bankgirot.se/globalassets/dokument/anvandarmanualer/bankernaskontonummeruppbyggnad_anvandarmanual_sv.pdf).

Installation
------------
```shell
composer require byrokrat/banking:^1.0
```

Usage
-----
<!-- @expectOutput Nordea1330011111111163300,111111-11163300001111111116 -->
```php
namespace byrokrat\banking;

$factory = new AccountFactory;
$account = $factory->createAccount('3300,1111111116');

// outputs Nordea
echo $account->getBankName();

// outputs 1 (true)
echo $account->getBankName() == BankNames::BANK_NORDEA;

// outputs 3300
echo $account->getClearingNumber();

// outputs 111111111
echo $account->getSerialNumber();

// outputs 6
echo $account->getCheckDigit();

// outputs 3300,111111-1116
echo $account->getNumber();

// outputs 3300001111111116
echo $account->get16();
```

See the list of [bank and format identifiers](/src/BankNames.php).

Api
---
Account numbers implement the [`AccountNumber`](/src/AccountNumber.php)
interface. AccountNumber defines the following api:

Signature                      | Returns                 | Description
:----------------------------- | :---------------------- | :------------------------------------------
getRawNumber()                 | string                  | Get the raw number
getNumber()                    | string                  | Get formatted number
__toString()                   | string                  | Shorthand to getNumber
getClearingNumber()            | string (4 digits)       | Get clearing number
getClearingCheckDigit()        | string (1 or 0 digits)  | Check digit of the clearing number
getSerialNumber()              | string (1 to 11 digits) | Get account serial number
getCheckDigit()                | string (1 digit)        | Get account check digit
get16()                        | string (16 digits)      | Generic 16 digit format
getBankName()                  | string                  | Name of Bank this number belongs to
equals(AccountNumber $account) | boolean                 | Check if $account is equals current object

Format of the raw account number
--------------------------------
When processing a raw account number the following rules apply:

1. Spaces are removed.
1. Left side zeros are removed.
1. An optional `,` delimiter between clearing and serial numbers may be used.
1. Other characters then digits and `,` are ignored.

The following formats are all valid (and considered equal):

    91501111134
    9150,1111134
    9150,111113-4
    9150,111 113-4

### Clearing number check digits for Swedbank accounts

Swedbank account numbers with clearing numbers starting with `8` may specify a
fifth clearing number check digit. The clearing number check digit is optional,
but if present the parser will use it to validate the clearing number.

The following formats are valid (and equal):

    81050,744202466
    8105-0,744202466

> Please note that if the clearing check digit is `0` and no `,` is used to
> separate the clearing and serial numbers the parser may not understand that
> the `0` is part of the clearing number, resulting in data loss. For this
> reason it is a good habit to always use a `,` to separate the clearing and
> serial numbers.

Parsing Bankgiro and PlusGiro accounts
--------------------------------------
The `-` delimiter is optional when parsing Bankgiro and PlusGiro account numbers.
When omitted it may not be possible determine if the raw number is indeed a
Bankgiro or PlusGiro account number: `5805-6201` is a valid Bankgiro number and
`5805620-1` is a valid PlusGiro number.

This issue is resolved by using the dedicated factories `BankgiroFactory` and
`PlusgiroFactory` instead of the regular `AccountFactory`.

<!-- @expectOutput 1 -->
```php
namespace byrokrat\banking;

$account = (new PlusgiroFactory)->createAccount('58056201');

// true
echo $account->getBankName() == BankNames::BANK_PLUSGIRO;
```

<!-- @expectOutput 1 -->
```php
namespace byrokrat\banking;

$account = (new BankgiroFactory)->createAccount('58056201');

// true
echo $account->getBankName() == BankNames::BANK_BANKGIRO;
```
