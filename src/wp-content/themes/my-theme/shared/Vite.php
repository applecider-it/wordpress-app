<?php

declare(strict_types=1);

namespace MyApp;

/**
 * Vite管理
 */
class Vite
{
    private static bool $is_dev;
    private static ?array $manifest = null;
    private static int $port = 3000;
    private static string $prefix = '/wp-content/themes/my-theme/dist';

    /** 初期化 */
    public static function init(): ?string
    {
        self::$is_dev = WP_DEBUG;
        $manifest_path = dirname(__DIR__) . '/dist/.vite/manifest.json';

        if (self::$is_dev) {
            $url = 'http://localhost:' . self::$port . '/@vite/client';
            return self::importJsTag($url);
        } else {
            self::$manifest = json_decode(file_get_contents($manifest_path), true);

            return null;
        }
    }

    /** JSからの読み込み */
    public static function importJs(string $path): string
    {
        if (self::$is_dev) {
            $url = 'http://localhost:' . self::$port . '/' . $path;

            return self::importJsTag($url);
        } else {
            $data = self::$manifest[$path];
            $url = self::$prefix . '/' . $data['file'];

            $html = self::importJsTag($url);

            // JSから読み込むときには、CSSの読み込みもある場合があるので、その対応
            if (isset($data['css'])) {
                foreach ($data['css'] as $css) {
                    $url = self::$prefix . '/' . $css;
                    $html .= self::importCssTag($url);
                }
            }

            return $html;
        }
    }

    /** CSSからの読み込み */
    public static function importCss(string $path): string
    {
        if (self::$is_dev) {
            $url = 'http://localhost:' . self::$port . '/' . $path;

            return self::importCssTag($url);
        } else {
            $data = self::$manifest[$path];
            $url = self::$prefix . '/' . $data['file'];

            return self::importCssTag($url);
        }
    }

    private static function importJsTag(string $url): string
    {
        return '<script type="module" src="' . $url . '"></script>';
    }

    private static function importCssTag(string $url): string
    {
        return '<link rel="stylesheet" href="' . $url . '" type="text/css" media="all" />';
    }
}
