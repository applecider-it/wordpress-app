<?php

/**
 * トップページ
 */

$img = get_template_directory_uri() . '/assets/image/sample.svg';

$frontPageConfig = MyTheme\loadConfig('front-page');

$baseDir = __DIR__ . '/templates/front-page';

?>
<?php get_header(); ?>

<div class="mt-5">
	<?php include($baseDir . '/cards.php'); ?>

	<div class="my-10">
		<?php MyTheme\slideShow($frontPageConfig['slideList1']); ?>
	</div>
	<div class="my-10">
		<?php MyTheme\slideShow($frontPageConfig['slideList2']); ?>
	</div>
</div>

<?php get_footer(); ?>