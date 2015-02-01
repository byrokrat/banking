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
     * @param  array    $data
     * @param  Resolver $resolver
     * @return Parser[]
     */
    public function createParsers(array $data, Resolver $resolver)
    {
        $parsers = [];

        foreach ($data as $parserId => $parserData) {
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
