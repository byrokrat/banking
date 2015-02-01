<?php

namespace byrokrat\banking;

/**
 * Create parser collection
 */
class ParserFactory
{
    /**
     * Create parser collection
     *
     * @param JsonParser|null $data The parses data
     * @param JsonParser|null $keys The key resolver data
     */
    public function createParsers(JsonParser $data = null, JsonParser $keys = null)
    {
        $data = $data ?: new JsonParser(file_get_contents(__DIR__ . '/data/parsers.json'));
        $keys = $keys ?: new JsonParser(file_get_contents(__DIR__ . '/data/keys.json'));

        $resolver = new Resolver($keys->getData());
        $parsers = [];

        foreach ($data->getData() as $parserId => $parserData) {
            $validators = [];

            foreach ($parserData['validators'] as $classname) {
                $classname = $resolver->resolve($classname);
                $validators[] = new $classname;
            }

            $parsers[$parserId] = new Parser(
                $resolver->resolve($parserData['bank']),
                $resolver->resolve($parserData['struct']),
                $parserData['clearing'],
                $validators
            );
        }

        return $parsers;
    }
}
