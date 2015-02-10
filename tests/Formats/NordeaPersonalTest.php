<?php

namespace byrokrat\banking;

/**
 * @covers \byrokrat\banking\NordeaPersonal
 */
class NordeaPersonalTest extends AccountNumberTestCase
{
    public function getFormatId()
    {
        return BankNames::FORMAT_NORDEA_PERSONAL;
    }

    public function getBankIdentifier()
    {
        return BankNames::BANK_NORDEA;
    }

    public function invalidStructureProvider()
    {
        return [
            ['3300,111111111'],
            ['3300,11111111111'],
            ['3300,0001111111111'],
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

    public function validProvider()
    {
        return [
            ['3300,1111111116',   '3300', '', '111111111', '6'],
            ['3300,001111111116', '3300', '', '111111111', '6'],
            ['3300,01111111116',  '3300', '', '111111111', '6'],
            ['3300001111111116',  '3300', '', '111111111', '6'],
            ['330000111111111-6', '3300', '', '111111111', '6'],
            ['3300,111111-1116',  '3300', '', '111111111', '6'],
            ['3300,8411283941',   '3300', '', '841128394', '1'],
            ['3300841128-394-1',  '3300', '', '841128394', '1'],
        ];
    }

    public function testInvalidDate()
    {
        $this->setExpectedException('byrokrat\banking\Exception\InvalidAccountNumberException');
        $this->buildAccount('3300,8413283949');
    }

    public function testGetPersonalId()
    {
        $this->assertInstanceOf(
            'byrokrat\id\PersonalId',
            $this->buildAccount('3300,1111111116')->getPersonalId()
        );
    }
}
