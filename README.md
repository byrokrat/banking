# ledgr/banking

[![Latest Stable Version](https://poser.pugx.org/ledgr/banking/v/stable.png)](https://packagist.org/packages/ledgr/banking)
[![Build Status](https://travis-ci.org/ledgr/banking.png?branch=master)](https://travis-ci.org/ledgr/banking)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ledgr/banking/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ledgr/banking/?branch=master)
[![Dependency Status](https://gemnasium.com/ledgr/banking.png)](https://gemnasium.com/ledgr/banking)

Data types for accounts in the swedish banking system

> Install using [composer](http://getcomposer.org/). Exists as **ledgr/banking** in
> the packagist repository.


Usage
-----

```php
use ledgr\banking\AccountFactory;
$factory = new AccountFactory();
$account = $factory->create('3300,1111111116');
// $account is an instance of ledgr\banking\NordeaPersonal
```
