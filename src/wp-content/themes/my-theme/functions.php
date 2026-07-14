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

// CSS、JSの読み込み設定
add_action('wp_enqueue_scripts', function () {
    $is_dev = WP_DEBUG;

    $manifest = null;
    $manifest_path = get_template_directory() . '/dist/.vite/manifest.json';
    if ($is_dev) {
        wp_enqueue_script('vite-client', 'http://localhost:3000/@vite/client', [], null);
    } else {
        $manifest = json_decode(file_get_contents($manifest_path), true);
    }

    $getUrl = function ($path) use ($is_dev, $manifest) {
        if ($is_dev) {
            return 'http://localhost:3000/' . $path;
        } else {
            $data = $manifest[$path];
            return get_template_directory_uri() . '/dist/' . $data['file'];
        }
    };

    wp_enqueue_script('myapp-app.js', $getUrl('src/entrypoints/app.js'), [], null, true);
    wp_enqueue_style('myapp-app.css', $getUrl('src/entrypoints/app.css'));

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

add_filter('script_loader_tag', function ($tag, $handle) {
    if (in_array($handle, ['myapp-app.js'])) {
        // 既存のtype属性を除去
        $tag = preg_replace('/\stype=(["\'])[^"\']*\1/', '', $tag);
        // <script の直後に type="module" を追加
        $tag = str_replace('<script ', '<script type="module" ', $tag);
    }
    return $tag;
}, 20, 2);
