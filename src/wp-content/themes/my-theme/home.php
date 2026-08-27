<?php

/**
 * ブログ一覧
 */

use MyApp\Services\Web\View;

$view = new View;

echo $view->render('blog/index');
