<?php

namespace byrokrat\banking;

class ResolverTest extends \PHPUnit_Framework_TestCase
{
    public function testExceptionOnUndefinedKey()
    {
        $this->setExpectedException('byrokrat\banking\Exception\LogicException');
        (new Resolver([]))->resolve('$key');
    }

    public function testTranslateKey()
    {
        $this->assertSame(
            'foobar',
            (new Resolver(['$key' => 'foobar']))->resolve('$key')
        );
    }

    public function testGetValueAsDefined()
    {
        $this->assertSame(
            'foobar',
            (new Resolver([]))->resolve('foobar')
        );
    }
}
