# Banking

[![Packagist Version](https://img.shields.io/packagist/v/byrokrat/banking.svg?style=flat-square)](https://packagist.org/packages/byrokrat/banking)
[![Build Status](https://img.shields.io/travis/byrokrat/banking/master.svg?style=flat-square)](https://travis-ci.org/byrokrat/banking)
[![Quality Score](https://img.shields.io/scrutinizer/g/byrokrat/banking.svg?style=flat-square)](https://scrutinizer-ci.com/g/byrokrat/banking)
[![Scrutinizer Coverage](https://img.shields.io/scrutinizer/coverage/g/byrokrat/banking.svg?style=flat-square)](https://scrutinizer-ci.com/g/byrokrat/banking/?branch=master)

Data types and factories for bank accounts in the swedish banking system,
Handelsbanken, ICA-banken, Nordea, SEB, Skandiabanken, Swedbank, PlusGirot,
Bankgirot among others.

## Introduction

Banking provides a way of parsing and validating bank account numbers from the
swedish banking system. It validates clearing numbers, the structure of the
account number as well as check digits. It also defines value objects for account
numbers, with formatting capabilities and methods for accessing the different
parts of the account number and to identify the bank the number belongs to.

## Installation

```shell
composer require byrokrat/banking:^2.0
```

## Usage

The main entry point is the [AccountFactory](/src/AccountFactoryInterface.php) that is
used to create [AccountNumber](/src/AccountNumber.php) objects.

<!--
    @example factory
    @expectOutput "5000,111111-6"
-->
```php
$accountFactory = new \byrokrat\banking\AccountFactory;
$account = $accountFactory->createAccount('50001111116');
// Prints a formatted version of the validated number (5000,111 111-6)
echo $account->getNumber();
```

The standard factory does its best to recognize different number formats.

1. Spaces, hyphens and dots are ignored.
1. An optional `,` delimiter between clearing and serial numbers may be used.
1. Misplaced clearing-serial delimiters are ignored.

The following account numbers are all valid and considered equal to the account number
of the previous example.

<!--
    @example formats
    @include factory
    @expectOutput /1+$/
-->
```php
// Prints 111111
echo $accountFactory->createAccount('5000,1111116')->equals($account);
echo $accountFactory->createAccount('5000-1111116')->equals($account);
echo $accountFactory->createAccount('5000,111111-6')->equals($account);
echo $accountFactory->createAccount('5000,111 111-6')->equals($account);
echo $accountFactory->createAccount('5000000001111116')->equals($account);
echo $accountFactory->createAccount('5000,000001111116')->equals($account);
```

### Making the factory stricter

For a factory that only allows digits and correctly placed clearing-serial
delimiters (`,`) pass an instance of `StrictFactory` as the first argument to
`AccountFactory::__construct()`.

<!--
    @example StrictFactory
    @expectError
-->
```php
$accountFactory = new \byrokrat\banking\AccountFactory(new \byrokrat\banking\StrictFactory);

// Will throw an exception as '-' is not a valid character in strict mode
$accountFactory->createAccount('5000-1111116');
```

### Rewrites

When parsing an account number fails the standard factory attempts rewriting it
to see if a valid account number can be produced.

1. It tries to interpret the first digit of the serial number as a clearing check digit.
1. It tries to trim left side ceros from the serial number.
1. It tries to append the clearing number `3300` to see if the account number is
   a valid Nordea personal account number.

If any of the rewrites (or any combination of rewrites) is successful the rewritten
number is used. Opt out of this behaviour by passing an empty `RewriterContainer`
as the second argument to `AccountFactory::__construct()`.

<!--
    @example no-rewrites
    @expectError
-->
```php
$accountFactory = new \byrokrat\banking\AccountFactory(
    new \byrokrat\banking\StrictFactory,
    new \byrokrat\banking\Rewriter\RewriterContainer
);

// Will throw an exception as the serial number is too long and can not be trimmed.
$accountFactory->createAccount('5000,01111116');
```

### Clearing number check digits for Swedbank accounts

Swedbank account numbers with clearing numbers starting with `8` may specify a
fifth clearing number check digit. The clearing number check digit is optional,
but if present the parser will use it to validate the clearing number.

<!--
    @example swedbank
    @include factory
    @expectOutput /1$/
-->
```php
$swedbank = $accountFactory->createAccount('8105-9,744202466');
echo $accountFactory->createAccount('81059,744202466')->equals($swedbank);
```

> Please note that if the clearing check digit is `0` and no comma (`,`) is used
> to separate the clearing and serial numbers the parser may not understand that
> the `0` is part of the clearing number, resulting in data loss. For this
> reason it is a good habit to always use a comma to separate the clearing and
> serial numbers.

### Catching parser errors

When parsing fails an exception is thrown. Inspect the exception message for an
in-depth description of the parser stages and where the error occurred.

<!--
    @example error-message
    @include factory
    @expectOutput "/Unable to parse account/"
-->
```php
try {
    $accountFactory->createAccount('8105-8,744202464');
} catch (\byrokrat\banking\Exception $e) {
    echo $e->getMessage();
}
```

Outputs something like:

```
Unable to parse account 8105-8,744202464 using format Swedbank:
 * Clearing number 8105 is within range 8000 to 8999
 * [FAIL] Invalid check digit 4, expected 6
 * [FAIL] Invalid clearing number check digit 8, expected 9
 * Valid serial length 8
```

### Parsing Bankgiro and PlusGiro accounts

Use `BankgiroFactory` or `PlusgiroFactory` to parse bankgiro and plusgiro
account numbers. (As of version 2.0 it is no longer possible to parse bankgiro
or plusgiro account numbers using the regular `AccountFactory`.)

> Note that the `-` delimiter is optional when parsing Bankgiro and PlusGiro
> account numbers. When omitted it may not be possible determine if the raw
> number is indeed a Bankgiro or PlusGiro account number: `5805-6201` is a valid
> Bankgiro number and `5805620-1` is a valid PlusGiro number.

<!--
    @example plusgiro
    @expectOutput 1
-->
```php
$account = (new \byrokrat\banking\PlusgiroFactory)->createAccount('58056201');
echo $account->getBankName() == \byrokrat\banking\BankNames::BANK_PLUSGIRO;
```

<!--
    @example bankgiro
    @expectOutput 1
-->
```php
$account = (new \byrokrat\banking\BankgiroFactory)->createAccount('58056201');
echo $account->getBankName() == \byrokrat\banking\BankNames::BANK_BANKGIRO;
```

## The AccountNumber API

Created account objects implement the [AccountNumber](/src/AccountNumber.php)
interface, which defines the following api.

#### `getBankName()`

Gets the name of the bank a number belongs to (for a list of bank identifiers
see [BankNames](/src/BankNames.php)).

<!--
    @example getBankName
    @include factory
    @expectOutput "/SEB1$/"
-->
```php
echo $account->getBankName();
echo $account->getBankName() == \byrokrat\banking\BankNames::BANK_SEB;
```

#### `getRawNumber()`

Gets the raw and unformatted number.

<!--
    @example getRawNumber
    @include factory
    @expectOutput "/50001111116$/"
-->
```php
echo $account->getRawNumber();
```

#### `getNumber()`

Gets a formatted permutation of account number. Using PHPs magical `__tostring()`
method calls `getNumber()` internaly.

<!--
    @example getNumber
    @include factory
    @expectOutput "/5000,111111-65000,111111-6$/"
-->
```php
echo $account->getNumber();
echo $account;
```

#### `prettyprint()`

Gets a formatted permutation of account number with more eye candy.

<!--
    @example prettyprint
    @include factory
    @expectOutput "/5000,111 111-6$/"
-->
```php
echo $account->prettyprint();
```

#### `get16()`

Gets the generic 16 digit format as defined by BGC.

<!--
    @example get16
    @include factory
    @expectOutput "/5000000001111116$/"
-->
```php
echo $account->get16();
```

#### `getClearingNumber()`, `getClearingCheckDigit()`, `getSerialNumber()` and `getCheckDigit()`

Gets the extracted account number parts.

<!--
    @example parts
    @include factory
    @expectOutput "/50001111116$/"
-->
```php
echo $account->getClearingNumber();
echo $account->getClearingCheckDigit();
echo $account->getSerialNumber();
echo $account->getCheckDigit();
```

#### `equals()`

Validates that two account objects represents the same number.

<!--
    @example equals
    @include factory
    @expectOutput "/1$/"
-->
```php
echo $account->equals($account);
```
