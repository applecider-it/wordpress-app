<?php

/**
 * ブログ記事
 */

use MyApp\Services\Web\View;

$view = new View;

echo $view->render('blog/show');
