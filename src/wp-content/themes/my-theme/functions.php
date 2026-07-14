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

// CSS、JSの読み込み設定
add_action('wp_enqueue_scripts', function () {
    // プラグインで使うJSもここで読み込む

    // Vue 3 を読み込み
    wp_enqueue_script(
        'vue-cdn',
        'https://unpkg.com/vue@3/dist/vue.global.js',
        [],
        '3.x'
    );

    // Axios を読み込み
    wp_enqueue_script(
        'axios-cdn',
        'https://unpkg.com/axios/dist/axios.min.js',
        [],
        '1.x'
    );
});

add_filter('script_loader_tag', function ($tag, $handle) {
    if (in_array($handle, ['myapp-app.js', 'vite-client'])) {
        // 既存のtype属性を除去
        $tag = preg_replace('/\stype=(["\'])[^"\']*\1/', '', $tag);
        // <script の直後に type="module" を追加
        $tag = str_replace('<script ', '<script type="module" ', $tag);
    }
    return $tag;
}, 20, 2);
