<?php

use function Myapp\Helpers\app;

$vite = app('vite');
?>
<?= $vite->importJs('resources/js/entrypoints/slideshow.ts') ?>