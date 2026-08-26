<?php

/**
 * テーマ、プラグインの共通処理
 */

require_once dirname(__DIR__) . '/vendor/autoload.php';

require_once __DIR__ . '/Helpers/helpers.php';

MyApp\Services\System\Bootstrap::init();
