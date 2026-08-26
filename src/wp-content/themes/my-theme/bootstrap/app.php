<?php

/**
 * テーマ、プラグインの共通処理
 */

require_once dirname(__DIR__) . '/vendor/autoload.php';

require_once dirname(__DIR__) . '/app/Helpers/helpers.php';

MyApp\Services\System\Bootstrap::init();
