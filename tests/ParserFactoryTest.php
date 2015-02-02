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
            "vars" => ['$validator' => get_class()],
            "formats" => [
                [
                    'id' => 'fromatA',
                    'structure' => '/regexp/',
                    'class' => 'ClassA',
                    'validators' => [
                        [
                            'class' => '$validator',
                            'arg' => null
                        ]
                    ]
                ],
                [
                    'id' => 'fromatB',
                    'structure' => '/regexp/',
                    'class' => 'ClassB',
                    'validators' => []
                ]
            ]
        ];

        $formats = $this->getMockBuilder('byrokrat\banking\JsonDecoder')
            ->disableOriginalConstructor()
            ->getMock();

        $formats->expects($this->atLeastOnce())
            ->method('getData')
            ->will($this->returnValue($data));

        $parsers = (new ParserFactory)->createParsers($formats);

        $this->assertCount(2, $parsers);
        $this->assertInstanceOf('byrokrat\banking\Parser', $parsers['fromata']);
    }
}
