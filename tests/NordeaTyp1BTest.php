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

class NordeaTyp1BTest extends \PHPUnit_Framework_TestCase
{
    public function invalidClearingProvider()
    {
        return array(
            array('3999,1'),
            array('5000,1'),
        );
    }

    /**
     * @expectedException \ledgr\banking\Exception\InvalidClearingException
     * @dataProvider invalidClearingProvider
     */
    public function testInvalidClearing($nr)
    {
        new NordeaTyp1B($nr);
    }

    public function invalidStructuresProvider()
    {
        return array(
            array('4000,111111'),
            array('4000,11111'),
            array('4000,11111111'),
            array('4000,0000001111111'),
        );
    }

    /**
     * @dataProvider invalidStructuresProvider
     * @expectedException \ledgr\banking\Exception\InvalidStructureException
     */
    public function testInvalidStructure($nr)
    {
        new NordeaTyp1B($nr);
    }

    public function invalidCheckDigitProvider()
    {
        return array(
            array('4000,1111111'),
        );
    }

    /**
     * @dataProvider invalidCheckDigitProvider
     * @expectedException \ledgr\banking\Exception\InvalidCheckDigitException
     */
    public function testInvalidCheckDigit($nr)
    {
        new NordeaTyp1B($nr);
    }

    public function validProvider()
    {
        return array(
            array('4000,1111112'),
            array('4000,000001111112'),
        );
    }

    /**
     * @dataProvider validProvider
     */
    public function testConstruct($nr)
    {
        new NordeaTyp1B($nr);
        $this->assertTrue(true);
    }

    public function testToString()
    {
        $m = new NordeaTyp1B('4000,000001111112');
        $this->assertEquals((string)$m, '4000,1111112');
    }

    public function testTo16()
    {
        $m = new NordeaTyp1B('4000,1111112');
        $this->assertEquals($m->to16(), '4000000001111112');
    }

    public function testGetType()
    {
        $m = new NordeaTyp1B('4000,1111112');
        $this->assertEquals($m->getType(), 'Nordea');
    }
}
