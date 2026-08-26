<?php

namespace MyApp\Services\Web;

/**
 * View管理
 */
class View
{
    protected string $baseDir;

    function __construct()
    {
        $this->baseDir = dirname(dirname(dirname(__DIR__))) . '/resources/views';
    }

    /** 生成 */
    function render(string $name, array $data = [])
    {
        ob_start();

        $path = $this->baseDir. '/' . $name . '.php';

        require($path);

        return ob_get_clean();
    }
}
