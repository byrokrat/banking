<?php

namespace byrokrat\banking\Account;

/**
 * @covers \byrokrat\banking\Account\PlusGiro
 */
class PlusGiroClearingTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'PlusGiroClearing';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\Plusgiro';
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
