Banking
=======

[![Packagist Version](https://img.shields.io/packagist/v/byrokrat/banking.svg?style=flat-square)](https://packagist.org/packages/byrokrat/banking)
[![Build Status](https://img.shields.io/travis/byrokrat/banking/master.svg?style=flat-square)](https://travis-ci.org/byrokrat/banking)
[![Quality Score](https://img.shields.io/scrutinizer/g/byrokrat/banking.svg?style=flat-square)](https://scrutinizer-ci.com/g/byrokrat/banking)
[![Scrutinizer Coverage](https://img.shields.io/scrutinizer/coverage/g/byrokrat/banking.svg?style=flat-square)](https://scrutinizer-ci.com/g/byrokrat/banking/?branch=master)
[![Dependency Status](https://img.shields.io/gemnasium/byrokrat/banking.svg?style=flat-square)](https://gemnasium.com/byrokrat/banking)

Data types for accounts in the swedish banking system

Installation
------------
```shell
composer require byrokrat/banking
```

Usage
-----
```php
$factory = new \byrokrat\banking\AccountFactory;
$account = $factory->createAccount('3300,1111111116');

echo $account->getBankName();   // Nordea

$account instanceof \byrokrat\banking\Account\NordeaPersonal; // true
$account instanceof \byrokrat\banking\AccountNumber;          // true
```

### Format of the account number

1. Spaces are ignored.
1. An optional `,` delimiter between clearing and serial numbers may be used.
1. An optional `-` delimiter may be used before check digits.

The following formats are all valid

    14053542562
    1405,3542562
    1405,354256-2
    1405,354 256-2

#### Clearing number check digits for Swedbank accounts

Swedbank account numbers with clearing numbers starting with `8` may specify a
fifth clearing number check digit. The clearing number check digit is optional,
but if used a `,` must be used to mark where the clearing number ends and the
serial number begins.

The following formats are valid

    81050,744202466
    8105-0,744202466

Api
---
[`AccountNumber`](/src/AccountNumber.php) defines the following api:

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

Credits
-------
Banking is covered under the [WTFPL](http://www.wtfpl.net/)

@author Hannes Forsgård (hannes.forsgard@fripost.org)
