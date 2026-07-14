<?php

/**
 * テーマ、プラグインの共通処理
 */

namespace MyApp;

require_once __DIR__ . '/Vite.php';

class App {
    private static array $container;
    public static function init() {
        self::$container['vite'] = new Vite;
    }
    public static function get($name) {
        return self::$container[$name];
    }
}

App::init();
