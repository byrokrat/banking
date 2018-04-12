<?php

declare(strict_types = 1);

namespace byrokrat\banking\Format;

class FormatFactoryTest extends \PHPUnit\Framework\TestCase
{
    public function testCreateFormats()
    {
        $this->assertInstanceOf(
            FormatContainer::CLASS,
            (new FormatFactory)->createFormats()
        );
    }
}
