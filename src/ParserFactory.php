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
     * @param  JsonDecoder|null $formats
     * @return Parser[]
     */
    public function createParsers(JsonDecoder $formats = null)
    {
        $formats = $formats ?: new JsonDecoder(file_get_contents(__DIR__ . '/formats.json'));
        $resolver = new Resolver($formats->getData()['vars']);

        /** @var Parser[] $parsers */
        $parsers = [];

        foreach ($formats->getData()['formats'] as $format) {
            /** @var Validator[] $validators */
            $validators = [];

            foreach ($format['validators'] as $validatorData) {
                $validatorClass = $resolver->resolve($validatorData['class']);
                $validators[] = new $validatorClass($validatorData['arg']);
            }

            $parsers[strtolower($format['id'])] = new Parser(
                $resolver->resolve($format['structure']),
                $resolver->resolve($format['class']),
                $validators
            );
        }

        return $parsers;
    }
}
