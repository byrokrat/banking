<?php

namespace byrokrat\banking;

/**
 * @covers \byrokrat\banking\ParserFactory
 */
class ParserFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateParsers()
    {
        $data = [
            [
                'struct' => 'structure',
                'bank' => 'bank',
                'clearing' => [1000, 1999],
                'validators' => [
                    get_class()
                ]
            ],
            [
                'struct' => 'structure',
                'bank' => 'bank2',
                'clearing' => [1000, 1999],
                'validators' => []
            ]
        ];

        $parserData = $this->getMockBuilder('byrokrat\banking\JsonParser')
            ->disableOriginalConstructor()
            ->getMock();

        $parserData->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($data));

        $keyData = $this->getMockBuilder('byrokrat\banking\JsonParser')
            ->disableOriginalConstructor()
            ->getMock();

        $keyData->expects($this->once())
            ->method('getData')
            ->will($this->returnValue([]));

        $parsers = (new ParserFactory)->createParsers($parserData, $keyData);
        $this->assertCount(2, $parsers);
        $this->assertInstanceOf('byrokrat\banking\Parser', $parsers[0]);
    }
}
