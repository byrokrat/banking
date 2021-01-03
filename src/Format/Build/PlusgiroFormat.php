<?php

declare(strict_types=1);

namespace byrokrat\banking\Format\Build;

/**
 * This class has been auto-generated and should not be edited directly
 *
 * Generated in accordance with BGC specifications dated 2020-04-15.
 */
class PlusgiroFormat implements \byrokrat\banking\Format\FormatInterface
{
    use \byrokrat\banking\Format\ValidatorJitCache;

    public function getBankName(): string
    {
        return \byrokrat\banking\BankNames::BANK_PLUSGIRO;
    }

    protected function getClearingValidator(): \byrokrat\banking\Validator\ValidatorInterface
    {
        return new \byrokrat\banking\Validator\ClearingValidator([[9500, 9549], [9960, 9969]]);
    }

    /**
     * @return \byrokrat\banking\Validator\ValidatorInterface[]
     */
    protected function getAdditionalValidators(): array
    {
        return [
            new \byrokrat\banking\Validator\CheckDigitType2Validator(),
            new \byrokrat\banking\Validator\StructType2Validator(),
            new \byrokrat\banking\Validator\NoClearingCheckDigitValidator(),
        ];
    }
}
