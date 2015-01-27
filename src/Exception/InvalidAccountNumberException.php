<?php

namespace byrokrat\banking\Exception;

/**
 * Subclasses of this exception are thrown when a account number is invalid
 */
class InvalidAccountNumberException extends \RuntimeException implements \byrokrat\banking\Exception
{
}
