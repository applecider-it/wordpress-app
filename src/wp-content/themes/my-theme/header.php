<?php

/**
 * ヘッダー
 */

use Myapp\App;

$vite = App::get('vite');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title><?php echo wp_get_document_title(); ?></title>

	<?= $vite->init() ?>
	<?= $vite->importJs('resources/js/entrypoints/app.ts') ?>
	<?= $vite->importCss('resources/css/app.css') ?>

	<?php
	if (is_singular()) {
		wp_enqueue_script('comment-reply');
	}
	?>

	<?php wp_head(); ?>
</head>

<body class="bg-gray-200">
	<div class="bg-gradient-to-br from-indigo-100 via-white to-blue-100 min-h-screen">

		<div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
			<!-- Logo -->
			<a href="/">
				<div
					class="text-2xl font-bold bg-gradient-to-r from-indigo-500 to-purple-500 bg-clip-text text-transparent">
					MySite
				</div>
			</a>

			<!-- Desktop Menu -->
			<nav>
				<?php wp_nav_menu(array('theme_location' => 'main-menu')); ?>
			</nav>

		</div>

		<div class="pb-20">