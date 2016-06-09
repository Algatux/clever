<?php

declare(strict_types = 1);

namespace Clever\Config;


/**
 * Class ApplicationConfiguration
 */
final class ApplicationConfiguration
{

    /** @var Fluent */
    private $config;

    /**
     * ApplicationConfiguration constructor.
     */
    public function __construct()
    {
        $this->config = new Fluent(include __DIR__."/../config.php");
    }

    /**
     * @return Fluent
     */
    public function getConfig(): Fluent
    {
        return $this->config;
    }

}
