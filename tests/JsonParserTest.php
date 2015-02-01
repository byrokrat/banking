<?php

namespace byrokrat\banking;

class JsonParserTest extends \PHPUnit_Framework_TestCase
{
    public function testExceptionOnInvalidJson()
    {
        $this->setExpectedException('byrokrat\banking\Exception\LogicException');
        new JsonParser('this-is-not-valid-json');
    }

    public function testParseJson()
    {
        $this->assertSame(
            ['key' => ['nested' => 'value']],
            (new JsonParser('{"key": {"nested":"value"}}'))->getData()
        );
    }
}
