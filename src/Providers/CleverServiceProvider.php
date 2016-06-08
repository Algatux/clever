<?php

declare(strict_types = 1);

namespace Clever\Providers;

use Illuminate\Support\ServiceProvider;

abstract class CleverServiceProvider extends ServiceProvider
{

    /**
     * Register the console commands
     *
     * @return void
     */
    abstract public function registerConsoleCommands();

}
