<?php

namespace byrokrat\banking;

/**
 * @covers \byrokrat\banking\PlusGiro
 */
class PlusGiroClearingTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_PLUSGIRO_CLEARING;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_PLUSGIRO;
    }

    public function validProvider()
    {
        return [
            ['9500,210918-9', '9500', '', '210918',  '9'],
            ['9500,43950948', '9500', '', '4395094', '8'],
            ['99609564048',   '9960', '', '956404',  '8'],
        ];
    }
}
