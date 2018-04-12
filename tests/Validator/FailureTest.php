<?php

declare(strict_types = 1);

namespace byrokrat\banking\Validator;

class FailureTest extends \PHPUnit\Framework\TestCase
{
    public function testIsValid()
    {
        $this->assertFalse((new Failure(''))->isValid());
    }

    public function testGetMessage()
    {
        $this->assertSame(
            '[FAIL] foobar',
            (new Failure('foobar'))->getMessage()
        );
    }
}
