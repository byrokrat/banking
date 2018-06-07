<?php

declare(strict_types = 1);

namespace byrokrat\banking\Validator;

class ResultCollectionTest extends \PHPUnit\Framework\TestCase
{
    public function testSuccessIfAllResultsAreSuccess()
    {
        $result = $this->prophesize(ResultInterface::CLASS);
        $result->isValid()->willReturn(true);
        $result->getMessage()->willReturn('');
        $result = $result->reveal();

        $this->assertTrue((new ResultCollection($result, $result))->isValid());
    }

    public function testFailureIfOneResultsIsFailure()
    {
        $result = $this->prophesize(ResultInterface::CLASS);
        $result->isValid()->willReturn(false);
        $result->getMessage()->willReturn('');
        $result = $result->reveal();

        $this->assertFalse((new ResultCollection($result))->isValid());
    }

    public function testGetMessage()
    {
        $result = $this->prophesize(ResultInterface::CLASS);
        $result->isValid()->willReturn(false);
        $result->getMessage()->willReturn('foo');
        $result = $result->reveal();

        $this->assertSame(
            " * foo\n * foo\n * foo",
            (new ResultCollection($result, $result, $result))->getMessage()
        );
    }
}
