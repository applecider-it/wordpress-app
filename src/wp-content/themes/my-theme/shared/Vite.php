<?php

declare(strict_types=1);

namespace MyApp;

/**
 * Vite管理
 */
class Vite
{
    private bool $isDev;
    private string $devUrl;
    private string $prodUrl;

    private ?array $manifest = null;

    function __construct()
    {
        $this->isDev = WP_DEBUG;
        $this->devUrl = 'http://localhost:3000';
        $this->prodUrl = '/wp-content/themes/my-theme/dist';

        $manifest_path = dirname(__DIR__) . '/dist/.vite/manifest.json';

        if (!$this->isDev) {
            $this->manifest = json_decode(file_get_contents($manifest_path), true);
        }
    }

    /** 初期処理 */
    public function init(): string
    {
        if ($this->isDev) {
            $url = $this->devUrl . '/@vite/client';
            return $this->importJsTag($url);
        } else {
            return '';
        }
    }

    /** JSからの読み込み */
    public function importJs(string $path): string
    {
        if ($this->isDev) {
            $url = $this->devUrl . '/' . $path;

            return $this->importJsTag($url);
        } else {
            $data = $this->manifest[$path];
            $url = $this->prodUrl . '/' . $data['file'];

            $html = $this->importJsTag($url);

            // JSから読み込むときには、CSSの読み込みもある場合があるので、その対応
            if (isset($data['css'])) {
                foreach ($data['css'] as $css) {
                    $url = $this->prodUrl . '/' . $css;
                    $html .= $this->importCssTag($url);
                }
            }

            return $html;
        }
    }

    /** CSSからの読み込み */
    public function importCss(string $path): string
    {
        if ($this->isDev) {
            $url = $this->devUrl . '/' . $path;

            return $this->importCssTag($url);
        } else {
            $data = $this->manifest[$path];
            $url = $this->prodUrl . '/' . $data['file'];

            return $this->importCssTag($url);
        }
    }

    private function importJsTag(string $url): string
    {
        return '<script type="module" src="' . $url . '"></script>';
    }

    private function importCssTag(string $url): string
    {
        return '<link rel="stylesheet" href="' . $url . '" type="text/css" media="all" />';
    }
}
