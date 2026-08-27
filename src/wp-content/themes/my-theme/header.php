<?php

/**
 * ヘッダー
 */

use MyApp\Services\Web\View;

$view = new View;

echo $view->render('layouts/header');
