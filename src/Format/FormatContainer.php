<?php

declare(strict_types = 1);

namespace byrokrat\banking\Format;

use byrokrat\banking\AccountNumber;
use byrokrat\banking\Exception\InvalidClearingNumberException;

/**
 * Container of format object
 */
class FormatContainer
{
    /**
     * @var FormatInterface[];
     */
    private $formats;

    public function __construct(FormatInterface ...$formats)
    {
        $this->formats = $formats;
    }

    public function getFormatFromClearing(AccountNumber $account): FormatInterface
    {
        foreach ($this->formats as $format) {
            if ($format->isValidClearing($account)) {
                return $format;
            }
        }

        throw new InvalidClearingNumberException("Unknown clearing number: '{$account->getClearingNumber()}'");
    }
}
