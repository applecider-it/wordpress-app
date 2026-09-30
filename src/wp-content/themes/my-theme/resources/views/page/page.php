<?php

/**
 * 固定ページ
 */
?>
<?php get_header(); ?>

<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		<article class="max-w-3xl mx-auto px-6 py-16">
			<h1 class="text-4xl font-bold mb-4">
				<?php the_title(); ?>
			</h1>

			<div class="app-post-content-container max-w-none">
				<?php the_content(); ?>
			</div>
		</article>
	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>