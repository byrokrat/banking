<?php
/**
 * This file is part of ledgr/banking.
 *
 * Copyright (c) 2014 Hannes Forsgård
 *
 * ledgr/banking is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * ledgr/banking is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ledgr/banking.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace ledgr\banking;

class SwedbankTyp1Test extends \PHPUnit_Framework_TestCase
{
    public function invalidClearingProvider()
    {
        return array(
            array('6999,1'),
            array('8000,1'),
        );
    }

    /**
     * @expectedException \ledgr\banking\Exception\InvalidClearingException
     * @dataProvider invalidClearingProvider
     */
    public function testInvalidClearing($nr)
    {
        new SwedbankTyp1($nr);
    }

    public function invalidStructuresProvider()
    {
        return array(
            array('7000,111111'),
            array('7000,11111'),
            array('7000,11111111'),
            array('7000,0000001111111'),
        );
    }

    /**
     * @dataProvider invalidStructuresProvider
     * @expectedException \ledgr\banking\Exception\InvalidStructureException
     */
    public function testInvalidStructure($nr)
    {
        new SwedbankTyp1($nr);
    }

    public function invalidCheckDigitProvider()
    {
        return array(
            array('7000,1111111'),
            array('7822,1420650'),
            array('7950,1450700'),
        );
    }

    /**
     * @dataProvider invalidCheckDigitProvider
     * @expectedException \ledgr\banking\Exception\InvalidCheckDigitException
     */
    public function testInvalidCheckDigit($nr)
    {
        new SwedbankTyp1($nr);
    }

    public function validProvider()
    {
        return array(
            array('7000,1111116'),
            array('7000,000001111116'),
            array('7822,1420654'),
            array('7950,1450708'),
        );
    }

    /**
     * @dataProvider validProvider
     */
    public function testConstruct($nr)
    {
        new SwedbankTyp1($nr);
        $this->assertTrue(true);
    }

    public function testToString()
    {
        $m = new SwedbankTyp1('7000,000001111116');
        $this->assertEquals((string)$m, '7000,1111116');
    }

    public function testGetType()
    {
        $m = new SwedbankTyp1('7000,1111116');
        $this->assertEquals($m->getType(), 'Swedbank');
    }
}
