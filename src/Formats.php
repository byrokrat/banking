<?php

namespace byrokrat\banking;

use byrokrat\banking\Validator\ClearingValidator;
use byrokrat\banking\Validator\PersonalIdValidator;
use byrokrat\banking\Validator\RawLengthValidator;
use byrokrat\banking\Validator\CheckDigitType1AValidator;
use byrokrat\banking\Validator\CheckDigitType1BValidator;
use byrokrat\banking\Validator\CheckDigitType2Validator;
use byrokrat\banking\Validator\CheckDigitHandelsbankenValidator;
use byrokrat\banking\Validator\ClearingCheckDigitValidator;

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
            self::FORMAT_NORDEA_1A => new Format(
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
                    new CheckDigitType1AValidator
                ]
            ),
            self::FORMAT_NORDEA_1B => new Format(
                self::BANK_NORDEA,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[4000, 4999]]),
                    new CheckDigitType1BValidator
                ]
            ),
            self::FORMAT_NORDEA_PERSONAL => new Format(
                self::BANK_NORDEA,
                '/^(\d{4})(),?0{0,2}(\d{6}-?\d{3})-?(\d)$/',
                'byrokrat\banking\NordeaPersonal',
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
            self::FORMAT_SEB => new Format(
                self::BANK_SEB,
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
                    new CheckDigitType1AValidator
                ]
            ),
            self::FORMAT_SWEDBANK_1 => new Format(
                self::BANK_SWEDBANK,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[7000, 7999]]),
                    new CheckDigitType1AValidator
                ]
            ),
            self::FORMAT_SWEDBANK_2 => new Format(
                self::BANK_SWEDBANK,
                '/^(\d{4})(?:(?:-?(\d),)|,)?0{0,10}(\d{1,9})-?(\d)$/',
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[8000, 8999]]),
                    new CheckDigitType2Validator,
                    new RawLengthValidator(16),
                    new ClearingCheckDigitValidator,
                ]
            ),
            self::FORMAT_IKANO => new Format(
                self::BANK_IKANO,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9170, 9179]]),
                    new CheckDigitType1AValidator
                ]
            ),
            self::FORMAT_MARGINALEN => new Format(
                self::BANK_MARGINALEN,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9230, 9239]]),
                    new CheckDigitType1AValidator
                ]
            ),
            self::FORMAT_SBAB => new Format(
                self::BANK_SBAB,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9250, 9259]]),
                    new CheckDigitType1AValidator
                ]
            ),
            self::FORMAT_ICA => new Format(
                self::BANK_ICA,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9270, 9279]]),
                    new CheckDigitType1AValidator
                ]
            ),
            self::FORMAT_RESURS => new Format(
                self::BANK_RESURS,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9280, 9289]]),
                    new CheckDigitType1AValidator
                ]
            ),
            self::FORMAT_FOREX => new Format(
                self::BANK_FOREX,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9400, 9449]]),
                    new CheckDigitType1AValidator
                ]
            ),
            self::FORMAT_GE_MONEY => new Format(
                self::BANK_GE_MONEY,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9460, 9469]]),
                    new CheckDigitType1AValidator
                ]
            ),
            self::FORMAT_LANSFORSAKRINGAR_1A => new Format(
                self::BANK_LANSFORSAKRINGAR,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[3400, 3409], [9060, 9069]]),
                    new CheckDigitType1AValidator
                ]
            ),
            self::FORMAT_LANSFORSAKRINGAR_1B => new Format(
                self::BANK_LANSFORSAKRINGAR,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9020, 9029]]),
                    new CheckDigitType1BValidator
                ]
            ),
            self::FORMAT_DANSKE_1 => new Format(
                self::BANK_DANSKE,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[1200, 1399], [2400, 2499]]),
                    new CheckDigitType1AValidator
                ]
            ),
            self::FORMAT_DANSKE_2 => new Format(
                self::BANK_DANSKE,
                self::STRUCT_TYPE2,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9180, 9189]]),
                    new CheckDigitType2Validator
                ]
            ),
            self::FORMAT_ALANDSBANKEN => new Format(
                self::BANK_ALANDSBANKEN,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[2300, 2399]]),
                    new CheckDigitType1BValidator
                ]
            ),
            self::FORMAT_CITIBANK => new Format(
                self::BANK_CITIBANK,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9040, 9049]]),
                    new CheckDigitType1BValidator
                ]
            ),
            self::FORMAT_ROYAL_OF_SCOTLAND => new Format(
                self::BANK_ROYAL_OF_SCOTLAND,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9090, 9099]]),
                    new CheckDigitType1BValidator
                ]
            ),
            self::FORMAT_NORDNET => new Format(
                self::BANK_NORDNET,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9100, 9109]]),
                    new CheckDigitType1BValidator
                ]
            ),
            self::FORMAT_SKANDIABANKEN => new Format(
                self::BANK_SKANDIABANKEN,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9150, 9169]]),
                    new CheckDigitType1BValidator
                ]
            ),
            self::FORMAT_DNB => new Format(
                self::BANK_DNB,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9190, 9199], [9260, 9269]]),
                    new CheckDigitType1BValidator
                ]
            ),
            self::FORMAT_LANDSHYPOTEK => new Format(
                self::BANK_LANDSHYPOTEK,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9390, 9399]]),
                    new CheckDigitType1BValidator
                ]
            ),
            self::FORMAT_BNP_PARIBAS => new Format(
                self::BANK_BNP_PARIBAS,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9470, 9479]]),
                    new CheckDigitType1BValidator
                ]
            ),
            self::FORMAT_AVANZA => new Format(
                self::BANK_AVANZA,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9550, 9569]]),
                    new CheckDigitType1BValidator
                ]
            ),
            self::FORMAT_ERIK_PENSER => new Format(
                self::BANK_ERIK_PENSER,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9590, 9599]]),
                    new CheckDigitType1BValidator
                ]
            ),
            self::FORMAT_NORDAX => new Format(
                self::BANK_NORDAX,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9640, 9649]]),
                    new CheckDigitType1BValidator
                ]
            ),
            self::FORMAT_AMFA => new Format(
                self::BANK_AMFA,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9660, 9669]]),
                    new CheckDigitType1BValidator
                ]
            ),
            self::FORMAT_RIKSGALDEN_1 => new Format(
                self::BANK_RIKSGALDEN,
                self::STRUCT_TYPE1,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9880, 9889]]),
                    new CheckDigitType1BValidator
                ]
            ),
            self::FORMAT_RIKSGALDEN_2 => new Format(
                self::BANK_RIKSGALDEN,
                self::STRUCT_TYPE2,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9890, 9899]]),
                    new CheckDigitType2Validator
                ]
            ),
            self::FORMAT_SPARBANKEN_SYD => new Format(
                self::BANK_SPARBANKEN_SYD,
                self::STRUCT_TYPE2,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9570, 9579]]),
                    new CheckDigitType2Validator
                ]
            ),
            self::FORMAT_SPARBANKEN_ORESUND => new Format(
                self::BANK_SPARBANKEN_ORESUND,
                self::STRUCT_TYPE2,
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[9300, 9329], [9330, 9349]]),
                    new CheckDigitType2Validator
                ]
            ),
            self::FORMAT_HANDELSBANKEN => new Format(
                self::BANK_HANDELSBANKEN,
                '/^(\d{4})(),?0{0,3}(\d{8})-?(\d)$/',
                'byrokrat\banking\BaseAccount',
                [
                    new ClearingValidator([[6000, 6999]]),
                    new CheckDigitHandelsbankenValidator
                ]
            ),
            self::FORMAT_PLUSGIRO_CLEARING => new Format(
                self::BANK_PLUSGIRO,
                '/^(\d{4})(),?0{0,10}(\d{1,9})-?(\d)$/',
                'byrokrat\banking\PlusGiro',
                [
                    new ClearingValidator([[9500, 9549], [9960, 9969]]),
                    new CheckDigitType2Validator,
                    new RawLengthValidator(16)
                ]
            ),
            self::FORMAT_PLUSGIRO => new Format(
                self::BANK_PLUSGIRO,
                '/^(0{0,4})()0{0,10}(\d{1,7})-?(\d)$/',
                'byrokrat\banking\PlusGiro',
                [
                    new CheckDigitType2Validator,
                    new RawLengthValidator(16)
                ]
            ),
            self::FORMAT_BANKGIRO => new Format(
                self::BANK_BANKGIRO,
                '/^(0{0,4})()0{0,5}(\d{3,4}-?\d{3})(\d)$/',
                'byrokrat\banking\Bankgiro',
                [
                    new CheckDigitType2Validator,
                    new RawLengthValidator(16)
                ]
            ),
            self::FORMAT_UNKNOWN => new Format(
                self::BANK_UNKNOWN,
                '/^([1-9]\d{3})(),?(\d{6,11})-?(\d)$/',
                'byrokrat\banking\BaseAccount',
                []
            )
        ];
    }
}
