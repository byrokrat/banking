<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class HandelsbankenTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'handelsbanken';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['6000,301286698', '6000', '', '30128669', '8'],
        ];
    }
}
