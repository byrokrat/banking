<?php

namespace byrokrat\banking;

/**
 * @covers \byrokrat\banking\FormatFactory
 */
class FormatFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateFormats()
    {
        $formats = (new FormatFactory)->createFormats();
        $this->assertInternalType('array', $formats);
        $this->assertInstanceOf('byrokrat\banking\Format', $formats[BankNames::FORMAT_NORDEA_1B]);
    }
}
