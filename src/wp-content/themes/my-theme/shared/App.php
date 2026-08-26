<?php

namespace MyApp;

class App
{
    private static array $container;
    public static function init()
    {
        self::$container['vite'] = new Vite;
    }
    public static function get(string $name)
    {
        return self::$container[$name];
    }
}
