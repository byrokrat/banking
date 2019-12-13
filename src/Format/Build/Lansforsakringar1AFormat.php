<?php

declare(strict_types = 1);

namespace byrokrat\banking\Format\Build;

/**
 * This class has been auto-generated and should not be edited directly
 *
 * Generated in accordance with BGC specifications dated 2019-10-22.
 */
class Lansforsakringar1AFormat implements \byrokrat\banking\Format\FormatInterface
{
    use \byrokrat\banking\Format\ValidatorJitCache;

    public function getBankName(): string
    {
        return \byrokrat\banking\BankNames::BANK_LANSFORSAKRINGAR;
    }

    protected function getClearingValidator(): \byrokrat\banking\Validator\ValidatorInterface
    {
        return new \byrokrat\banking\Validator\ClearingValidator([[3400, 3409], [9060, 9069]]);
    }

    /**
     * @return \byrokrat\banking\Validator\ValidatorInterface[]
     */
    protected function getAdditionalValidators(): array
    {
        return [
            new \byrokrat\banking\Validator\CheckDigitType1AValidator,
            new \byrokrat\banking\Validator\StructType1Validator,
            new \byrokrat\banking\Validator\NoClearingCheckDigitValidator,
        ];
    }
}
