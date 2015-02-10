<?php

namespace byrokrat\banking;

use byrokrat\banking\Validator\ClearingValidator;
use byrokrat\banking\Validator\PersonalIdValidator;
use byrokrat\banking\Validator\MaxLengthValidator;

/**
 * Account number formats used when parsing
 */
class Formats implements BankNames
{
    /**
     * Structure for accounts of type 1
     */
    const STRUCT_TYPE1 = '/^(\d{4})(),?0{0,5}(\d{6})-?(\d)$/';

    /**
     * Structure for accounts of type 2
     */
    const STRUCT_TYPE2 = '/^(\d{4})(),?0{0,2}(\d{9})-?(\d)$/';

    /**
     * Get the array of formats
     *
     * Note that in rare occasions some of Swedbank's accounts cannot be validated
     * by a checksum calculation.
     *
     * Unknown is a special case account where all is valid.
     *
     * @return Format[]
     */
    public function createFormats()
    {
        return [
            'nordea_1a' => new Format(
                self::BANK_NORDEA,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator(
                        [
                            [1100, 1199],
                            [1400, 2099],
                            [3000, 3299],
                            [3301, 3399],
                            [3410, 3781],
                            [3783, 3999]
                        ]
                    ),
                    new \byrokrat\banking\Validator\CheckdigitType1AValidator
                ]
            ),
            'nordea_1b' => new Format(
                self::BANK_NORDEA,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[4000, 4999]]),
                    new \byrokrat\banking\Validator\CheckdigitType1BValidator
                ]
            ),
            'nordea_personal' => new Format(
                self::BANK_NORDEA,
                '/^(\d{4})(),?0{0,2}(\d{6}-?\d{3})-?(\d)$/',
                'byrokrat\banking\Account\NordeaPersonal',
                [
                    new ClearingValidator(
                        [
                            [3300, 3300],
                            [3782, 3782]
                        ]
                    ),
                    new PersonalIdValidator
                ]
            ),
            'seb' => new Format(
                self::BANK_NORDEA,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator(
                        [
                            [5000, 5999],
                            [9120, 9124],
                            [9130, 9149]
                        ]
                    ),
                    new \byrokrat\banking\Validator\CheckdigitType1AValidator
                ]
            ),
            'swedbank_1' => new Format(
                self::BANK_SWEDBANK,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[7000, 7999]]),
                    new \byrokrat\banking\Validator\CheckdigitType1AValidator
                ]
            ),
            'swedbank_2' => new Format(
                self::BANK_SWEDBANK,
                '/^(\d{4})(?:(?:-?(\d),)|,)?0{0,10}(\d{1,9})-?(\d)$/',
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[8000, 8999]]),
                    new \byrokrat\banking\Validator\CheckdigitType2Validator,
                    new MaxLengthValidator(16),
                    new \byrokrat\banking\Validator\ClearingCheckdigitValidator,
                ]
            ),
            'ikano' => new Format(
                self::BANK_IKANO,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9170, 9179]]),
                    new \byrokrat\banking\Validator\CheckdigitType1AValidator
                ]
            ),
            'marginalen' => new Format(
                self::BANK_MARGINALEN,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9230, 9239]]),
                    new \byrokrat\banking\Validator\CheckdigitType1AValidator
                ]
            ),
            'sbab' => new Format(
                self::BANK_SBAB,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9250, 9259]]),
                    new \byrokrat\banking\Validator\CheckdigitType1AValidator
                ]
            ),
            'ica' => new Format(
                self::BANK_ICA,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9270, 9279]]),
                    new \byrokrat\banking\Validator\CheckdigitType1AValidator
                ]
            ),
            'resurs' => new Format(
                self::BANK_RESURS,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9280, 9289]]),
                    new \byrokrat\banking\Validator\CheckdigitType1AValidator
                ]
            ),
            'forex' => new Format(
                self::BANK_FOREX,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9400, 9449]]),
                    new \byrokrat\banking\Validator\CheckdigitType1AValidator
                ]
            ),
            'ge_money_bank' => new Format(
                self::BANK_GE_MONEY,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9460, 9469]]),
                    new \byrokrat\banking\Validator\CheckdigitType1AValidator
                ]
            ),
            'lansforsakringar_1a' => new Format(
                self::BANK_LANSFORSAKRINGAR,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[3400, 3409], [9060, 9069]]),
                    new \byrokrat\banking\Validator\CheckdigitType1AValidator
                ]
            ),
            'lansforsakringar_1b' => new Format(
                self::BANK_LANSFORSAKRINGAR,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9020, 9029]]),
                    new \byrokrat\banking\Validator\CheckdigitType1BValidator
                ]
            ),
            'danske_bank_1' => new Format(
                self::BANK_DANSKE,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[1200, 1399], [2400, 2499]]),
                    new \byrokrat\banking\Validator\CheckdigitType1AValidator
                ]
            ),
            'danske_bank_2' => new Format(
                self::BANK_DANSKE,
                self::STRUCT_TYPE2,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9180, 9189]]),
                    new \byrokrat\banking\Validator\CheckdigitType2Validator
                ]
            ),
            'alandsbanken' => new Format(
                self::BANK_ALANDSBANKEN,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[2300, 2399]]),
                    new \byrokrat\banking\Validator\CheckdigitType1BValidator
                ]
            ),
            'citibank' => new Format(
                self::BANK_CITIBANK,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9040, 9049]]),
                    new \byrokrat\banking\Validator\CheckdigitType1BValidator
                ]
            ),
            'royal_bank_of_scotland' => new Format(
                self::BANK_ROYAL_OF_SCOTLAND,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9090, 9099]]),
                    new \byrokrat\banking\Validator\CheckdigitType1BValidator
                ]
            ),
            'nordnet' => new Format(
                self::BANK_NORDNET,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9100, 9109]]),
                    new \byrokrat\banking\Validator\CheckdigitType1BValidator
                ]
            ),
            'skandiabanken' => new Format(
                self::BANK_SKANDIABANKEN,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9150, 9169]]),
                    new \byrokrat\banking\Validator\CheckdigitType1BValidator
                ]
            ),
            'dnb' => new Format(
                self::BANK_DNB,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9190, 9199], [9260, 9269]]),
                    new \byrokrat\banking\Validator\CheckdigitType1BValidator
                ]
            ),
            'landshypotek' => new Format(
                self::BANK_LANDSHYPOTEK,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9390, 9399]]),
                    new \byrokrat\banking\Validator\CheckdigitType1BValidator
                ]
            ),
            'bnp_paribas' => new Format(
                self::BANK_BNP_PARIBAS,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9470, 9479]]),
                    new \byrokrat\banking\Validator\CheckdigitType1BValidator
                ]
            ),
            'avanza' => new Format(
                self::BANK_AVANZA,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9550, 9569]]),
                    new \byrokrat\banking\Validator\CheckdigitType1BValidator
                ]
            ),
            'erik_penser' => new Format(
                self::BANK_ERIK_PENSER,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9590, 9599]]),
                    new \byrokrat\banking\Validator\CheckdigitType1BValidator
                ]
            ),
            'nordax' => new Format(
                self::BANK_NORDAX,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9640, 9649]]),
                    new \byrokrat\banking\Validator\CheckdigitType1BValidator
                ]
            ),
            'amfa' => new Format(
                self::BANK_AMFA,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9660, 9669]]),
                    new \byrokrat\banking\Validator\CheckdigitType1BValidator
                ]
            ),
            'riksgalden_1' => new Format(
                self::BANK_RIKSGALDEN,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9880, 9889]]),
                    new \byrokrat\banking\Validator\CheckdigitType1BValidator
                ]
            ),
            'riksgalden_2' => new Format(
                self::BANK_RIKSGALDEN,
                self::STRUCT_TYPE2,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9890, 9899]]),
                    new \byrokrat\banking\Validator\CheckdigitType2Validator
                ]
            ),
            'sparbanken_syd' => new Format(
                self::BANK_SPARBANKEN_SYD,
                self::STRUCT_TYPE2,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9570, 9579]]),
                    new \byrokrat\banking\Validator\CheckdigitType2Validator
                ]
            ),
            'sparbanken_oresund' => new Format(
                self::BANK_SPARBANKEN_ORESUND,
                self::STRUCT_TYPE2,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9300, 9329], [9330, 9349]]),
                    new \byrokrat\banking\Validator\CheckdigitType2Validator
                ]
            ),
            'handelsbanken' => new Format(
                self::BANK_HANDELSBANKEN,
                '/^(\d{4})(),?0{0,3}(\d{8})-?(\d)$/',
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[6000, 6999]]),
                    new \byrokrat\banking\Validator\CheckdigitHandelsbankenValidator
                ]
            ),
            'plusgiro_clearing' => new Format(
                self::BANK_PLUSGIRO,
                '/^(\d{4})(),?0{0,10}(\d{1,9})-?(\d)$/',
                'byrokrat\banking\Account\PlusGiro',
                [
                    new ClearingValidator([[9500, 9549], [9960, 9969]]),
                    new \byrokrat\banking\Validator\CheckdigitType2Validator,
                    new MaxLengthValidator(16)
                ]
            ),
            'plusgiro' => new Format(
                self::BANK_PLUSGIRO,
                '/^(0{0,4})()0{0,10}(\d{1,7})-?(\d)$/',
                'byrokrat\banking\Account\PlusGiro',
                [
                    new \byrokrat\banking\Validator\CheckdigitType2Validator,
                    new MaxLengthValidator(16)
                ]
            ),
            'bankgiro' => new Format(
                self::BANK_BANKGIRO,
                '/^(0{0,4})()0{0,5}(\d{3,4}-?\d{3})(\d)$/',
                'byrokrat\banking\Account\Bankgiro',
                [
                    new \byrokrat\banking\Validator\CheckdigitType2Validator,
                    new MaxLengthValidator(16)
                ]
            ),
            'unknown' => new Format(
                self::UNKNOWN,
                '/^([1-9]\d{3})(),?(\d{6,11})-?(\d)$/',
                'byrokrat\banking\BaseAccount',
                []
            )
        ];
    }
}
