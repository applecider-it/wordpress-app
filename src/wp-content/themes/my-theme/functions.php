<?php

/**
 * 設定用のコード実行
 */

require_once __DIR__ . '/src/helpers.php';

// メニューの設定
add_theme_support('menus');
register_nav_menus(array(
    'main-menu' => 'Main Menu',
));

// テーマのセットアップ時に呼ばれる
add_action('after_setup_theme', function () {
    error_log('独自テーマをセットアップしました。');
});

// CSS、JSの読み込み設定
add_action('wp_enqueue_scripts', function () {
    // ビルドされたCSSを読み込む
    wp_enqueue_style(
        'tailwind',
        get_template_directory_uri() . '/dist/css/app.css',
        [],
        filemtime(__DIR__ . '/dist/css/app.css')
    );

    // swiper用設定

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
