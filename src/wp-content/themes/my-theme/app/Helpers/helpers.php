<?php

namespace MyApp\Helpers;

use Illuminate\Container\Container;

/**
 * ヘルパー
 */

/**
 * サービスコンテナ
 * 
 * $abstractの指定があるときは、コンテナに保存されているサービス。ないときは、コンテナを返す。
 */
function app($abstract = null)
{
    $container = Container::getInstance();

    return $abstract === null ? $container : $container->make($abstract);
}

/** 設定取得 */
function config(string $name)
{
    return app('config')->get($name);
}
