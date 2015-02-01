<?php

namespace byrokrat\banking;

/**
 * Wrapper around json_decode
 */
class JsonParser
{
    /**
     * @var string The parsed data
     */
    private $data;

    /**
     * Load json string
     *
     * @param string $json
     */
    public function __construct($json)
    {
        $this->data = json_decode($json, true);
        if ($this->data === null) {
            throw new Exception\LogicException("Unable to parse json, errorcode: " . json_last_error());
        }
    }

    /**
     * Get parsed json data
     *
     * @return array
     * @throws Exception\LogicException If unable to parse
     */
    public function getData()
    {
        return $this->data;
    }
}
