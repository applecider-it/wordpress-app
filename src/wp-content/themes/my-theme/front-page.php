<?php

/**
 * トップページ
 */

$img = get_template_directory_uri() . '/assets/image/sample.svg';

$slideList1 = [$img, $img, $img,];

$slideList2 = [$img, $img,];

$slideShow = function ($list) {
	include(__DIR__ . '/templates/common/slide-show.php');
};

$baseDir = __DIR__ . '/templates/front-page';

?>
<?php get_header(); ?>

<div class="mt-5">
	<?php include($baseDir . '/cards.php'); ?>

	<div class="my-10">
		<?php $slideShow($slideList1); ?>
	</div>
	<div class="my-10">
		<?php $slideShow($slideList2); ?>
	</div>
</div>

<?php get_footer(); ?>