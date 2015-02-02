<?php

namespace byrokrat\banking;

class JsonDecoderTest extends \PHPUnit_Framework_TestCase
{
    public function testExceptionOnInvalidJson()
    {
        $this->setExpectedException('byrokrat\banking\Exception\LogicException');
        new JsonDecoder('this-is-not-valid-json');
    }

    public function testParseJson()
    {
        $this->assertSame(
            ['key' => ['nested' => 'value']],
            (new JsonDecoder('{"key": {"nested":"value"}}'))->getData()
        );
    }
}
