<?php
declare(strict_types=1);
namespace Clever\Config;

use Illuminate\Support\Fluent;

/**
 * Class ApplicationConfiguration
 * @package Clever\Config
 */
class ApplicationConfiguration
{

    /** @var Fluent */
    private $config;

    /**
     * ApplicationConfiguration constructor.
     */
    public function __construct()
    {
        $this->config = new Fluent(include __DIR__ . "/../config.php");
    }

    /**
     * @return Fluent
     */
    public function getConfig(): Fluent
    {
        return $this->config;
    }
    
}
