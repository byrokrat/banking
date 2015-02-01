<?php

namespace byrokrat\banking;

/**
 * Account number factory
 */
class AccountFactory
{
    /**
     * @var Parser[] Loaded parsers
     */
    private $parsers;

    /**
     * Create parser collection
     */
    public function __construct()
    {
        $this->parsers = (new ParserFactory)->createParsers(
            json_decode(file_get_contents(__DIR__ . '/data/parsers.json'), true),
            new Resolver(json_decode(file_get_contents(__DIR__ . '/data/keys.json'), true))
        );
    }

    /**
     * Disable the catch all unknown account type
     *
     * @return null
     */
    public function disableUnknownAccount()
    {
        unset($this->parsers['Unknown']);
    }

    /**
     * Create bank account object using number
     *
     * @param  string $number
     * @return AccountNumber
     * @throws Exception\UnableToCreateAccountException If unable to create
     */
    public function createAccount($number)
    {
        foreach ($this->parsers as $parser) {
            try {
                return $parser->parse($number);
            } catch (Exception\InvalidAccountNumberException $e) {
                continue;
            }
        }
        throw new Exception\UnableToCreateAccountException("Unable to create account {$number}");
    }
}
