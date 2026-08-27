<?php

/**
 * トップページ
 */

use MyApp\Services\Web\View;

use function MyApp\Helpers\config;

$baseDir = __DIR__ . '/templates/front-page';

$view = new View;
?>
<?php get_header(); ?>

<?= $view->render('partials/ui/slide-show-import') ?>

<div class="mt-5">
	<?= $view->render('front-page/cards') ?>

	<div class="my-10">
		<?= $view->render('partials/ui/slide-show', ['list' => config('front-page.slideList1')]) ?>
	</div>

	<div class="my-10">
		<?= $view->render('partials/ui/slide-show', ['list' => config('front-page.slideList2')]) ?>
	</div>
</div>

<?php get_footer(); ?>