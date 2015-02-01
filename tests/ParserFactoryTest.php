<?php

namespace byrokrat\banking;

/**
 * @covers \byrokrat\banking\ParserFactory
 */
class ParserFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateParsers()
    {
        $validatorRes = $this->getMockBuilder('byrokrat\banking\Data\Resolver')
            ->disableOriginalConstructor()
            ->getMock();
        $validatorRes->expects($this->exactly(4))
            ->method('resolve')
            ->will($this->returnValue(get_class()));

        $structRes = $this->getMockBuilder('byrokrat\banking\Data\Resolver')
            ->disableOriginalConstructor()
            ->getMock();
        $structRes->expects($this->exactly(2))
            ->method('resolve')
            ->will($this->returnValue('bar'));

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

        $parsers = (new ParserFactory)->createParsers($data, $validatorRes, $structRes);
        $this->assertCount(2, $parsers);
        $this->assertInstanceOf('byrokrat\banking\Parser', $parsers[0]);
    }
}
