<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\Account\Handelsbanken
*/
class HandelsbankenTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'Handelsbanken';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Account\Handelsbanken';
    }

    public function validProvider()
    {
        return [
            ['6000,301286698', '6000', '', '30128669', '8'],
        ];
    }
}
