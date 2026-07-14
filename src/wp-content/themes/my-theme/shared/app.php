<?php

/**
 * テーマ、プラグインの共通処理
 */

namespace MyApp;

class Vite
{
    private static bool $is_dev;
    private static ?array $manifest = null;

    public static function init()
    {
        self::$is_dev = WP_DEBUG;
        $manifest_path = dirname(__DIR__) . '/dist/.vite/manifest.json';
        if (!self::$is_dev) {
            self::$manifest = json_decode(file_get_contents($manifest_path), true);
        }
    }
    public static function getUrl(string $path)
    {
        if (self::$is_dev) {
            return 'http://localhost:3000/' . $path;
        } else {
            $data = self::$manifest[$path];
            return '/wp-content/themes/my-theme/dist/' . $data['file'];
        }
    }
}

Vite::init();
