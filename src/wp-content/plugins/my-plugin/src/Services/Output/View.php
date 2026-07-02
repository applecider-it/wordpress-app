<?php

namespace MyPlugin\Services\Output;

/**
 * View管理
 */
class View
{
    /** 生成 */
    function render(string $name, array $data = [])
    {
        ob_start();

        $path = dirname(dirname(dirname(__DIR__))) . '/templates/' . $name . '.php';

        include($path);

        return ob_get_clean();
    }
}
