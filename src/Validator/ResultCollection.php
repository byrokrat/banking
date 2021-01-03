<?php

declare(strict_types=1);

namespace byrokrat\banking\Validator;

/**
 * A container of multiple results
 */
class ResultCollection implements ResultInterface
{
    /**
     * @var bool
     */
    private $isValid = true;

    /**
     * @var string[]
     */
    private $messages = [];

    public function __construct(ResultInterface ...$results)
    {
        foreach ($results as $result) {
            if (!$result->isValid()) {
                $this->isValid = false;
            }

            $this->messages[] = $result->getMessage();
        }
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }

    public function getMessage(): string
    {
        return ' * ' . implode("\n * ", $this->messages);
    }
}
