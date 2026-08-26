<?php

/**
 * トップページ
 */

use MyApp\Services\UI\SlideShow;

use function MyApp\Helpers\config;

$baseDir = __DIR__ . '/templates/front-page';

?>
<?php get_header(); ?>

<?php include(__DIR__ . '/templates/common/slide-show-import.php'); ?>

<div class="mt-5">
	<?php include($baseDir . '/cards.php'); ?>

	<div class="my-10">
		<?php SlideShow::slideShow(config('front-page.slideList1')); ?>
	</div>
	<div class="my-10">
		<?php SlideShow::slideShow(config('front-page.slideList2')); ?>
	</div>
</div>

<?php get_footer(); ?>