<?php

namespace MyPlugin;

class View
{
    function render(string $name, array $data = [])
    {
        ob_start();

        $path = dirname(__DIR__) . '/templates/' . $name . '.php';

        include($path);

        return ob_get_clean();
    }
}
