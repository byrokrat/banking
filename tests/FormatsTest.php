<?php

namespace byrokrat\banking;

/**
 * @covers \byrokrat\banking\Formats
 */
class FormatsTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateFormats()
    {
        $formats = (new Formats)->createFormats();
        $this->assertInternalType('array', $formats);
        $this->assertInstanceOf('byrokrat\banking\Format', $formats[BankNames::FORMAT_NORDEA_1B]);
    }
}
