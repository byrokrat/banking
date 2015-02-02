<?php

namespace byrokrat\banking\Bank;

/**
 * @covers \byrokrat\banking\Bank\Swedbank
 */
class SwedbankType2Test extends AccountNumberTestCase
{
    public function getParserName()
    {
        return 'SwedbankType2';
    }

    public function getClassName()
    {
        return '\byrokrat\banking\Bank\Swedbank';
    }

    public function invalidStructureProvider()
    {
        return array(
            array('8000,1'),
            array('8000,11111111111'),
        );
    }

    public function invalidClearingProvider()
    {
        return array(
            array('7999,11'),
            array('9000,11'),
        );
    }

    public function invalidCheckDigitProvider()
    {
        return array(
            array('8000,1111112'),
            array('8214,9837107772'),
            array('8150,9942266951'),
            array('8327,9940298181'),
            array('8214,9846665701'),
            array('8214,9844447351'),
            array('8006,5330010161'),
            array('8424,39984101'),
            array('8150,9942187552'),
            array('8214,9133844001'),
        );
    }

    public function validProvider()
    {
        return array(
            array('8000,1111111'),
            array('8000,000001111111'),
            array('8214,9837107771'),
            array('8150,9942266959'),
            array('8327,9940298186'),
            array('8214,9846665702'),
            array('8214,9844447350'),
            array('8006,5330010165'),
            array('8424,39984109'),
            array('8150,9942187551'),
            array('8214,9133844002'),
            array('8000,001111111116'),
            array('8105,744202466')
        );
    }
}
