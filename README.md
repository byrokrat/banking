> **NOTE:** Banking is under development and the API is subject to change.

# Banking

[![Packagist Version](https://img.shields.io/packagist/v/byrokrat/banking.svg?style=flat-square)](https://packagist.org/packages/byrokrat/banking)
[![Build Status](https://img.shields.io/travis/byrokrat/banking/master.svg?style=flat-square)](https://travis-ci.org/byrokrat/banking)
[![Quality Score](https://img.shields.io/scrutinizer/g/byrokrat/banking.svg?style=flat-square)](https://scrutinizer-ci.com/g/byrokrat/banking)
[![Scrutinizer Coverage](https://img.shields.io/scrutinizer/coverage/g/byrokrat/banking.svg?style=flat-square)](https://scrutinizer-ci.com/g/byrokrat/banking/?branch=master)
[![Dependency Status](https://img.shields.io/gemnasium/byrokrat/banking.svg?style=flat-square)](https://gemnasium.com/byrokrat/banking)

Data types for accounts in the swedish banking system

Installation
------------
Install using [composer](http://getcomposer.org/). Exists as
[byrokrat/banking](https://packagist.org/packages/byrokrat/banking)
in the [packagist](https://packagist.org/) repository:

    composer require byrokrat/banking

Usage
-----
```php
use byrokrat\banking\AccountFactory;
$factory = new AccountFactory();
$account = $factory->create('3300,1111111116');
// $account is an instance of byrokrat\banking\NordeaPersonal
```

Credits
-------
Banking is covered under the [WTFPL](http://www.wtfpl.net/)

@author Hannes Forsgård (hannes.forsgard@fripost.org)
