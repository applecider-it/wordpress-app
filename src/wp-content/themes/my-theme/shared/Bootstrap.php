<?php

namespace MyApp;

use Illuminate\Config\Repository;

class Bootstrap
{
    public static function init()
    {
        app()->singleton('vite', function () {
            return new Vite;
        });

        app()->singleton('config', function () {
            return new Repository(include(dirname(__DIR__) . '/config/config.php'));
        });
    }
}
