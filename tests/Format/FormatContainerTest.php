<?php

declare(strict_types=1);

namespace byrokrat\banking\Format;

use byrokrat\banking\AccountNumber;
use byrokrat\banking\Exception\InvalidClearingNumberException;

class FormatContainerTest extends \PHPUnit\Framework\TestCase
{
    use \Prophecy\PhpUnit\ProphecyTrait;

    public function testGetFormat()
    {
        $account = $this->prophesize(AccountNumber::CLASS)->reveal();

        $format1 = $this->prophesize(FormatInterface::CLASS);
        $format1->isValidClearing($account)->willReturn(false);
        $format1 = $format1->reveal();

        $format2 = $this->prophesize(FormatInterface::CLASS);
        $format2->isValidClearing($account)->willReturn(true);
        $format2 = $format2->reveal();

        $this->assertSame(
            $format2,
            (new FormatContainer($format1, $format2))->getFormatFromClearing($account)
        );
    }

    public function testExceptionOnUnknownClearing()
    {
        $this->expectException(InvalidClearingNumberException::CLASS);
        (new FormatContainer())->getFormatFromClearing($this->createMock(AccountNumber::CLASS));
    }
}
