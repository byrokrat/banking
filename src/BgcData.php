<?php

namespace remove;

/**
 * Swedish account types as described by BGC 2014-07-01
 *
 * @todo Flytta över alla värden till parsers.json
 */
class BgcData
{
    public function type2Accounts()
    {
        return [
            [9180, 9189, self::STRUCT_TYPE2, self::VALIDATOR_TYPE2, self::BANK_DANSKE, 1],
            [6000, 6999, self::STRUCT_HANDELSBANKEN, self::VALIDATOR_HANDELSBANKEN, self::BANK_HANDELSBANKEN, 2],
            [9500, 9549, self::STRUCT_PLUSGIRO, self::VALIDATOR_TYPE2, self::BANK_NORDEA_PLUSGIROT, 3],
            [9960, 9969, self::STRUCT_PLUSGIRO, self::VALIDATOR_TYPE2, self::BANK_NORDEA_PLUSGIROT, 3],
            # [3300, 3300, self::STRUCT_TYPE2, self::VALIDATOR_TYPE2, self::BANK_NORDEA, 1], // personkonto
            # [3782, 3782, self::STRUCT_TYPE2, self::VALIDATOR_TYPE2, self::BANK_NORDEA, 1], // personkonto
            [9890, 9899, self::STRUCT_TYPE2, self::VALIDATOR_TYPE2, self::BANK_RIKSGALDEN, 1],
            [9570, 9579, self::STRUCT_TYPE2, self::VALIDATOR_TYPE2, self::BANK_SPARBANKEN_SYD, 1],
            [9300, 9329, self::STRUCT_TYPE2, self::VALIDATOR_TYPE2, self::BANK_SPARBANKEN_ORESUND, 1],
            [9330, 9349, self::STRUCT_TYPE2, self::VALIDATOR_TYPE2, self::BANK_SPARBANKEN_ORESUND, 1],
            # [8000, 8999, self::STRUCT_SWEDBANK_TYPE2, self::VALIDATOR_TYPE2, self::BANK_SWEDBANK, 3],
        ];
    }

    public function type1Accounts()
    {
        return [
            # [1100, 1199, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1A, self::BANK_NORDEA],
            [1200, 1399, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1A, self::BANK_DANSKE],
            # [1400, 2099, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1A, self::BANK_NORDEA],
            [2300, 2399, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1B, self::BANK_ALANDSBANKEN],
            [2400, 2499, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1A, self::BANK_DANSKE],
            # [3000, 3299, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1A, self::BANK_NORDEA],
            # [3301, 3399, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1A, self::BANK_NORDEA],
            [3400, 3409, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1A, self::BANK_LANSFORSAKRINGAR],
            # [3410, 3781, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1A, self::BANK_NORDEA],
            # [3783, 3999, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1A, self::BANK_NORDEA],
            # [4000, 4999, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1B, self::BANK_NORDEA],
            # [5000, 5999, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1A, self::BANK_SEB],
            # [7000, 7999, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1A, self::BANK_SWEDBANK],
            [9020, 9029, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1B, self::BANK_LANSFORSAKRINGAR],
            [9040, 9049, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1B, self::BANK_CITIBANK],
            [9060, 9069, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1A, self::BANK_LANSFORSAKRINGAR],
            [9090, 9099, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1B, self::BANK_ROYAL_OF_SCOTLAND],
            [9100, 9109, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1B, self::BANK_NORDNET],
            # [9120, 9124, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1A, self::BANK_SEB],
            # [9130, 9149, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1A, self::BANK_SEB],
            [9150, 9169, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1B, self::BANK_SKANDIABANKEN],
            [9170, 9179, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1A, self::BANK_IKANO],
            [9190, 9199, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1B, self::BANK_DNB],
            [9230, 9239, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1A, self::BANK_MARGINALEN],
            [9250, 9259, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1A, self::BANK_SBAB],
            [9260, 9269, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1B, self::BANK_DNB],
            [9270, 9279, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1A, self::BANK_ICA],
            [9280, 9289, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1A, self::BANK_RESURS],
            [9390, 9399, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1B, self::BANK_LANDSHYPOTEK],
            [9400, 9449, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1A, self::BANK_FOREX],
            [9460, 9469, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1A, self::BANK_GE_MONEY],
            [9470, 9479, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1B, self::BANK_BNP_PARIBAS],
            [9550, 9569, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1B, self::BANK_AVANZA],
            [9590, 9599, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1B, self::BANK_ERIK_PENSER],
            [9640, 9649, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1B, self::BANK_NORDAX],
            [9660, 9669, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1B, self::BANK_AMFA],
            [9880, 9889, self::STRUCT_TYPE1, self::VALIDATOR_TYPE1B, self::BANK_RIKSGALDEN],
        ];
    }
}
