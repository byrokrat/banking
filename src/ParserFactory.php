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
     * @param  array         $data
     * @param  Data\Resolver $validatorRes
     * @param  Data\Resolver $structRes
     * @return Parser[]
     */
    public function createParsers(array $data, Data\Resolver $validatorRes, Data\Resolver $structRes)
    {
        $parsers = [];

        foreach ($data as $parserId => $parserData) {
            $validators = [];

            foreach ($parserData['validators'] as $classname) {
                $classname = $validatorRes->resolve($classname);
                $validators[] = new $classname;
            }

            $parsers[$parserId] = new Parser(
                $parserData['bank'],
                $structRes->resolve($parserData['struct']),
                $parserData['clearing'],
                $validators
            );
        }

        return $parsers;
    }
}
