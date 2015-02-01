<?php

namespace byrokrat\banking;

/**
 * Account number factory
 */
class NumberFactory
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
            new Resolver(json_decode(file_get_contents(__DIR__ . '/data/validators.json'), true)),
            new Resolver(json_decode(file_get_contents(__DIR__ . '/data/structures.json'), true))
        );
    }

    /**
     * Create bank account object using number
     *
     * @param  string $number
     * @return AccountNumberInterface
     * @throws Exception\UnableToCreateAccountException If unable to create
     */
    public function createNumber($number)
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
