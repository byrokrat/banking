<?php

namespace byrokrat\banking;

/**
 * @covers \byrokrat\banking\ParserFactory
 */
class ParserFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateParsers()
    {
        $resolver = $this->getMockBuilder('byrokrat\banking\Resolver')
            ->disableOriginalConstructor()
            ->getMock();

        $resolver->expects($this->exactly(8))
            ->method('resolve')
            ->will($this->returnValue(get_class()));

        $data = [
            [
                'struct' => 'structure',
                'bank' => 'bank',
                'clearing' => [1000, 1999],
                'validators' => [
                    'validator_1',
                    'validator_2'
                ]
            ],
            [
                'struct' => 'structure',
                'bank' => 'bank2',
                'clearing' => [1000, 1999],
                'validators' => [
                    'validator_1',
                    'validator_2'
                ]
            ]
        ];

        $parsers = (new ParserFactory)->createParsers($data, $resolver);
        $this->assertCount(2, $parsers);
        $this->assertInstanceOf('byrokrat\banking\Parser', $parsers[0]);
    }
}
