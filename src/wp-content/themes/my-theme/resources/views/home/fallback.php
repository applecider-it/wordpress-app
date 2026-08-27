<?php

/**
 * フォールバックテンプレート
 */
?>
<?php get_header(); ?>

<div>!!!!! index.php !!!!!</div>

<?php if (have_posts()) : ?>
	<div>!!!!! have_posts !!!!!</div>
	<?php while (have_posts()) : the_post(); ?>
		<div>!!!!! post loop !!!!!</div>

		<h2><?php the_title(); ?></h2>
		<div>
			<?php the_content(); ?>
		</div>

	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>