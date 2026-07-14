<?php

/**
 * 設定用のコード実行
 */

require_once WP_CONTENT_DIR . '/themes/my-theme/shared/app.php';

require_once __DIR__ . '/src/helpers.php';

// メニューの設定
add_theme_support('menus');
register_nav_menus(array(
    'main-menu' => 'Main Menu',
));
