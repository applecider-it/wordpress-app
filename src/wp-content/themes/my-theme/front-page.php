<?php

/**
 * トップページ
 */

use MyApp\Services\Web\View;

$view = new View;

echo $view->render('home/front-page');
