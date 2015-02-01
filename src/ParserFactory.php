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
     * @param  array    $parserData
     * @param  Resolver $validatorResolver
     * @param  Resolver $structResolver
     * @return Parser[]
     */
    public function createParsers(array $parserData, Resolver $validatorResolver, Resolver $structResolver)
    {
        $parsers = [];

        foreach ($parserData as $parserId => $data) {
            $validators = [];

            foreach ($data['validators'] as $classname) {
                $classname = $validatorResolver->resolve($classname);
                $validators[] = new $classname;
            }

            $parsers[$parserId] = new Parser(
                $data['bank'],
                $structResolver->resolve($data['struct']),
                $data['clearing'],
                $validators
            );
        }

        return $parsers;
    }
}
