<?php

namespace byrokrat\banking\Exception;

/**
 * Error in pakage logic, this exception should never be thrown
 */
class LogicException extends \LogicException implements \byrokrat\banking\Exception
{
}
