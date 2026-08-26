<?php

namespace MyApp\Services\System;

use Illuminate\Config\Repository;
use MyApp\Services\Web\Vite;

use function MyApp\Helpers\app;

class Bootstrap
{
    public static function init()
    {
        app()->singleton('vite', function () {
            return new Vite;
        });

        app()->singleton('config', function () {
            return new Repository(include(dirname(dirname(dirname(__DIR__))) . '/config/config.php'));
        });
    }
}
