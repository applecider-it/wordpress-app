<?php

/**
 * ブログ記事
 */
?>
<?php get_header(); ?>

<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

		<article class="max-w-3xl mx-auto px-6 py-16">
			<h1 class="text-4xl font-bold mb-20">
				<?php the_title(); ?>
			</h1>

			<div class="app-post-content-container max-w-none">
				<?php the_content(); ?>
			</div>
		</article>

		<div class="mt-64">
			<?php comments_template(); ?>
		</div>
	<?php endwhile; ?>
<?php endif; ?>

</section>

<?php get_footer(); ?>