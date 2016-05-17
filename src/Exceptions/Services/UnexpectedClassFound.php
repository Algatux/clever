<?php
declare(strict_types=1);
namespace Clever\Exceptions\Services;

/**
 * Class UnexpectedClassFound
 * @package Clever\Exceptions\Services
 */
class UnexpectedClassFound extends \Exception
{

    public function __construct($message, $previousException = null)
    {
        parent::__construct($message, 0, $previousException);
    }

}
