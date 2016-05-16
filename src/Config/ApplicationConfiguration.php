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

    /** @var array */
    private $config;

    /**
     * ApplicationConfiguration constructor.
     */
    public function __construct()
    {
        include __DIR__ . "/../config.php";

        /** @var array $configuration */
        $this->config = new Fluent($configuration);
    }

    /**
     * @return Fluent
     */
    public function getConfig()
    {
        return $this->config;
    }
    
}
