<?php

namespace byrokrat\banking\Bank;

use byrokrat\id\PersonalId;

/**
 * @covers \byrokrat\banking\Bank\NordeaPersonal
 */
class NordeaPersonalTest extends AccountNumberTestCase
{
    public function getParserName()
    {
        return 'NordeaPersonal';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Bank\NordeaPersonal';
    }

    public function invalidStructureProvider()
    {
        return [
            ['3300,111111111'],
            ['3300,11111111111'],
            ['3300,0001111111111']
        ];
    }

    public function invalidClearingProvider()
    {
        return [
            ['3301,8411283941'],
        ];
    }

    public function invalidCheckDigitProvider()
    {
        return [
            ['3300,8411283940'],
        ];
    }
    
    public function testInvalidDate()
    {
        // Month number 13 does not exist
        $this->setExpectedException('byrokrat\banking\Exception\InvalidAccountNumberException');
        $this->buildAccount('3300,8413283949');
    }

    public function validProvider()
    {
        return [
            ['3300,1111111116'],
            ['3300,001111111116'],
            ['3300,1111111116'],
            ['3300,01111111116'],
            ['3300,001111111116'],
            ['3300001111111116'],
            ['3300,8411283941'],
            ['3300,001111111116'],
            ['3300,1111111116'],
            ['3300,001111111116'],
            ['3300,001111111116'],
            ['330000111111111-6'],
            ['3300,111111-1116'],
            ['3300841128-394-1'],
        ];
    }

    public function testGetPersonalId()
    {
        $this->assertEquals(
            new PersonalId('111111-1116'),
            $this->buildAccount('3300,1111111116')->getPersonalId()
        );
    }
}
