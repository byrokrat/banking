<?php

namespace byrokrat\banking\Account;

/**
  * @covers \byrokrat\banking\BaseAccount
*/
class AlandsbankenTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return 'alandsbanken';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\BaseAccount';
    }

    public function validProvider()
    {
        return [
            ['2300,1111133', '2300', '', '111113', '3'],
        ];
    }
}
