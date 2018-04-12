<?php

declare(strict_types = 1);

namespace byrokrat\banking\Validator;

class SuccessTest extends \PHPUnit\Framework\TestCase
{
    public function testIsValid()
    {
        $this->assertTrue((new Success(''))->isValid());
    }

    public function testGetMessage()
    {
        $this->assertSame(
            'foobar',
            (new Success('foobar'))->getMessage()
        );
    }
}
