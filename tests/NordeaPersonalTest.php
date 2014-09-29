<?php

namespace ledgr\banking;

use ledgr\id\PersonalId;

class NordeaPersonalTest extends \PHPUnit_Framework_TestCase
{
    public function invalidStructuresProvider()
    {
        return [
            ['3300,111111111'],
            ['3300,11111111111'],
            ['3300,0001111111111']
        ];
    }

    /**
     * @dataProvider invalidStructuresProvider
     * @expectedException ledgr\banking\Exception\InvalidStructureException
     */
    public function testInvalidStructure($number)
    {
        new NordeaPersonal($number);
    }

    public function testInvalidClearing()
    {
        $this->setExpectedException('ledgr\banking\Exception\InvalidClearingNumberException');
        new NordeaPersonal('3301,8411283941');
    }

    public function testInvalidCheckDigit()
    {
        $this->setExpectedException('ledgr\banking\Exception\InvalidCheckDigitException');
        // Check digit should be 1
        new NordeaPersonal('3300,8411283940');
    }

    public function testInvalidDate()
    {
        $this->setExpectedException('ledgr\banking\Exception\InvalidAccountNumberException');
        // Month number 13 does not exist
        new NordeaPersonal('3300,8413283949');
    }

    public function interchangeableFormulasProvider()
    {
        return [
            ['3300,1111111116',   '3300,001111111116'],
            ['3300,001111111116', '1111111116'],
            ['1111111116',        '001111111116'],
            ['01111111116',        '001111111116'],
            ['001111111116',      '3300001111111116'],
            ['3300001111111116',  '33001111111116'],
            ['8411283941',        '33008411283941']
        ];
    }

    /**
     * @dataProvider interchangeableFormulasProvider
     */
    public function testInterchangeableFormulas($numberA, $numberB)
    {
        $this->assertEquals(
            new NordeaPersonal($numberA),
            new NordeaPersonal($numberB)
        );
    }

    public function testToString()
    {
        $this->assertSame(
            '3300,1111111116',
            (string)new NordeaPersonal('3300,001111111116')
        );
    }

    public function testTo16()
    {
        $this->assertSame(
            '3300001111111116',
            (new NordeaPersonal('3300,1111111116'))->to16()
        );
    }

    public function testGetType()
    {
        $this->assertSame(
            'Nordea personkonto',
            (new NordeaPersonal('3300,001111111116'))->getType()
        );
    }

    public function testGetPersonalId()
    {
        $this->assertEquals(
            new PersonalId('111111-1116'),
            (new NordeaPersonal('3300,1111111116'))->getPersonalId()
        );
    }
}
