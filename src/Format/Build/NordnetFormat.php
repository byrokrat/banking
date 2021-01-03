<?php

declare(strict_types=1);

namespace byrokrat\banking\Format\Build;

/**
 * This class has been auto-generated and should not be edited directly
 *
 * Generated in accordance with BGC specifications dated 2020-04-15.
 */
class NordnetFormat implements \byrokrat\banking\Format\FormatInterface
{
    use \byrokrat\banking\Format\ValidatorJitCache;

    public function getBankName(): string
    {
        return \byrokrat\banking\BankNames::BANK_NORDNET;
    }

    protected function getClearingValidator(): \byrokrat\banking\Validator\ValidatorInterface
    {
        return new \byrokrat\banking\Validator\ClearingValidator([[9100, 9109]]);
    }

    /**
     * @return \byrokrat\banking\Validator\ValidatorInterface[]
     */
    protected function getAdditionalValidators(): array
    {
        return [
            new \byrokrat\banking\Validator\CheckDigitType1BValidator(),
            new \byrokrat\banking\Validator\StructType1Validator(),
            new \byrokrat\banking\Validator\NoClearingCheckDigitValidator(),
        ];
    }
}
