<?php

namespace byrokrat\banking\Data;

use byrokrat\banking\Exception\LogicException;

/**
 * Resolve data identifiers
 */
class Resolver
{
    /**
     * @var string[] Data substitution map
     */
    private $translations;

    /**
     * Load substitution map
     *
     * @param string[] $translations
     */
    public function __construct(array $translations)
    {
        $this->translations = $translations;
    }

    /**
     * Resolve identifier
     *
     * Translate if value is a translation key, otherwise return
     * value is defined.
     *
     * @param  string $value
     * @return string
     * @throws Exception\LogicException If value is a undefined key
     */
    public function resolve($value)
    {
        if ($this->isKey($value)) {
            return $this->translate($value);
        }
        return $value;
    }

    /**
     * Translate key
     *
     * @param  string $key
     * @return string
     * @throws LogicException If key does not exist
     */
    private function translate($key)
    {
        if (array_key_exists($key, $this->translations)) {
            return $this->translations[$key];
        }
        throw new LogicException("Key $key does not exist in resolver");
    }

    /**
     * Check if value is a substitution key
     *
     * @param  string  $value
     * @return boolean
     */
    private function isKey($value)
    {
        return preg_match('/^\$[a-z0-9_]+$/i', $value);
    }
}
