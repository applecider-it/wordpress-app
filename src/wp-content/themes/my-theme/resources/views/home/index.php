<?php

/**
 * トップページ
 */

use function MyApp\Helpers\config;
?>
<?php get_header(); ?>

<?= $this->render('partials/ui/slide-show-import') ?>

<div class="mt-5">
	<?= $this->render('home/partials/cards') ?>

	<div class="my-10">
		<?= $this->render('partials/ui/slide-show', ['list' => config('front-page.slideList1')]) ?>
	</div>

	<div class="my-10">
		<?= $this->render('partials/ui/slide-show', ['list' => config('front-page.slideList2')]) ?>
	</div>
</div>

<?php get_footer(); ?>