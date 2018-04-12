<?php

namespace byrokrat\banking\Exception;

/**
 * Error in package logic, this exception should never be thrown
 */
class LogicException extends \LogicException implements \byrokrat\banking\Exception
{
}
