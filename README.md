ledgr/banking
=============

[![Latest Stable Version](https://poser.pugx.org/ledgr/banking/v/stable.png)](https://packagist.org/packages/ledgr/banking)
[![Build Status](https://travis-ci.org/ledgr/banking.png?branch=master)](https://travis-ci.org/ledgr/banking)
[![Code Coverage](https://scrutinizer-ci.com/g/ledgr/banking/badges/coverage.png?s=6cf9972ea30cd3a2f7f89c032eceac422f5148cb)](https://scrutinizer-ci.com/g/ledgr/banking/)
[![Dependency Status](https://gemnasium.com/ledgr/banking.png)](https://gemnasium.com/ledgr/banking)

Data types for accounts in the swedish banking system

**License**: [GPL](/LICENSE)


Installation using [composer](http://getcomposer.org/)
------------------------------------------------------
Simply add `ledgr/banking` to your list of required libraries.


Usage
-----
    use ledgr\banking\BankAccountFactory;
    $account = BankAccountFactory::create('3300,1111111116');
    // $account is an instance of ledgr\banking\NordeaPerson


Run tests  using [phpunit](http://phpunit.de/)
----------------------------------------------
To run the tests you must first install dependencies using composer.

    $ curl -sS https://getcomposer.org/installer | php
    $ php composer.phar install
    $ phpunit
