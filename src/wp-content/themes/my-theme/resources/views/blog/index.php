<?php

/**
 * ブログ一覧
 */
?>
<?php get_header(); ?>

<section class="max-w-5xl mx-auto px-6 py-16">
	<h1 class="text-4xl font-bold mb-12">Blog</h1>

	<?php if (have_posts()) : ?>
		<div class="grid md:grid-cols-2 gap-8">
			<?php while (have_posts()) : the_post(); ?>
				<a
					href="<?php the_permalink(); ?>"
					class="block bg-white rounded-2xl shadow hover:shadow-xl transition p-6">
					<h2 class="text-xl font-semibold mb-2"><?php the_title(); ?></h2>

					<p class="text-gray-600 mb-4"><?php the_excerpt(); ?></p>
				</a>
			<?php endwhile; ?>
		</div>
	<?php endif; ?>

	<nav>
		<?php the_posts_pagination(); ?>
	</nav>
</section>

<?php get_footer(); ?>