<?php

declare(strict_types=1);

namespace byrokrat\banking\Format;

use byrokrat\banking\AccountNumber;
use byrokrat\banking\Validator\ValidatorInterface;
use byrokrat\banking\Validator\ResultInterface;
use byrokrat\banking\Validator\ResultCollection;

/**
 * Helper trait that manages validator creation and cache
 */
trait ValidatorJitCache
{
    /**
     * @var ValidatorInterface[]
     */
    private $validators;

    public function isValidClearing(AccountNumber $account): bool
    {
        return $this->getValidators()[0]->validate($account)->isValid();
    }

    public function validate(AccountNumber $account): ResultInterface
    {
        $results = [];

        foreach ($this->getValidators() as $validator) {
            $results[] = $validator->validate($account);
        }

        return new ResultCollection(...$results);
    }

    /**
     * Get clearing number validator
     */
    abstract protected function getClearingValidator(): ValidatorInterface;

    /**
     * Get additional validators that definies format
     *
     * @return ValidatorInterface[]
     */
    abstract protected function getAdditionalValidators(): array;

    /**
     * @return ValidatorInterface[]
     */
    private function getValidators(): array
    {
        if (!$this->validators) {
            $this->validators = $this->getAdditionalValidators();
            array_unshift($this->validators, $this->getClearingValidator());
        }

        return $this->validators;
    }
}
