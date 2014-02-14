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

class BankAccountFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $this->assertInstanceOf(
            "ledgr\\banking\\NordeaPerson",
            BankAccountFactory::create('3300,1111111116')
        );
    }

    public function testCreateBankgiro()
    {
        $this->assertInstanceOf(
            "ledgr\\banking\\Bankgiro",
            BankAccountFactory::create('111-1111')
        );
    }

    public function testCreateBankgiroUnvalidCheckdigit()
    {
        $this->assertInstanceOf(
            "ledgr\\banking\\UnknownAccount",
            BankAccountFactory::create('111-1112')
        );
    }

    /**
     * @expectedException ledgr\banking\Exception
     */
    public function testClassMissingError()
    {
        // Clearing numbers must have 4 digits
        BankAccountFactory::create('12345,1');
    }
}
