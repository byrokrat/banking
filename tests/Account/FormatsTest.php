<?php

namespace byrokrat\banking\Account;

use Seld\JsonLint\JsonParser;

class FormatsTest extends \PHPUnit_Framework_TestCase
{
    public function testValidJson()
    {
        (new JsonParser)->parse(file_get_contents(__DIR__ . '/../../src/Account/formats.json'));
    }
}
