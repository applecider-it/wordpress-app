<?php

/**
 * コメント部分
 */

use MyApp\Services\Web\View;

$view = new View;

echo $view->render('partials/comment/comments');
