# banking

Data types for accounts in the swedish banking system. Se `BankAccountFactory` for
a way to transparently create account objects.

**License**: [GPL](/LICENSE)


## Installation using [composer](http://getcomposer.org/)

Simply add `ledgr/banking` to your list of required libraries.


Creating bank account objects
-----------------------------
    use ledgr\banking\BankAccountFactory;
    $account = BankAccountFactory::create('3300,1111111116');
    // $account is an instance of ledgr\banking\NordeaPerson


Run tests
---------
Execute unit tests by typing `phpunit`. To run the tests you must first install
dependencies using composer.

    $ curl -sS https://getcomposer.org/installer | php
    $ php composer.phar install
    $ phpunit
