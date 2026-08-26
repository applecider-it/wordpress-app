<?php

/**
 * トップページ
 */

use MyTheme\UI;

use function MyApp\config;

$baseDir = __DIR__ . '/templates/front-page';

?>
<?php get_header(); ?>

<div class="mt-5">
	<?php include($baseDir . '/cards.php'); ?>

	<div class="my-10">
		<?php UI::slideShow(config('front-page.slideList1')); ?>
	</div>
	<div class="my-10">
		<?php UI::slideShow(config('front-page.slideList2')); ?>
	</div>
</div>

<?php get_footer(); ?>