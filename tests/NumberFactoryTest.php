<?php

namespace byrokrat\banking;

/**
 * @covers \byrokrat\banking\NumberFactory
 */
class NumberFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testExceptionWhenUnableToCreate()
    {
        $this->setExpectedException('byrokrat\banking\Exception\UnableToCreateAccountException');
        (new NumberFactory)->createNumber('this-is-not-a-valid-number');
    }

    public function testCreateNumbers()
    {
        $this->assertInstanceOf(
            'byrokrat\banking\AccountNumberInterface',
            (new NumberFactory)->createNumber('3000,1111116')
        );
    }
}
