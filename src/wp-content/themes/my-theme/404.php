<?php

/**
 * Not Found
 */

use MyApp\Services\Web\View;

$view = new View;

echo $view->render('partials/errors/404');
