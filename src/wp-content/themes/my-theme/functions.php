<?php

/**
 * 設定用のコード実行
 */

require_once __DIR__ . '/src/helpers.php';

add_theme_support('menus');
register_nav_menus(array(
	'main-menu' => 'Main Menu',
));

add_action('after_setup_theme', function () {
	//echo 123;
});

add_action('wp_enqueue_scripts', function () {
	wp_enqueue_style(
		'tailwind',
		get_template_directory_uri() . '/dist/css/app.css',
		[],
		filemtime(__DIR__ . '/dist/css/app.css')
	);

	// Swiper CSS
	wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css', [], '10.0.0');

	// Swiper JS
	wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js', [], '10.0.0', true);

	wp_enqueue_script(
		'my-swiper',
		get_template_directory_uri() . '/assets/js/swiper-init.js',
		['swiper'],
		filemtime(__DIR__ . '/assets/js/swiper-init.js')
	);
});
