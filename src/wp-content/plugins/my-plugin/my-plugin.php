<?php
/*
Plugin Name: My Plugin
Description: Myプラグイン
Version: 1.0
Author: Your Name
*/

if (!defined('ABSPATH')) {
    exit; // 直接アクセス防止
}

// オートロード設定
spl_autoload_register(function ($class) {
    $prefix = 'MyPlugin\\';

    if (strpos($class, $prefix) === 0) {
        $relative = str_replace('\\', '/', substr($class, strlen($prefix)));

        require_once __DIR__ . '/src/' . $relative . '.php';
    }
});

// プラグイン追加時に動作する処理
register_activation_hook(__FILE__, function () {
    $install = new MyPlugin\Services\System\Install;

    $install->exec();
});

// API設定
add_action('rest_api_init', function () {
    register_rest_route('myplugin', '/contact', [
        'methods' => 'POST',
        'callback' => function (WP_REST_Request $request) {
            $ctrl = new MyPlugin\Controllers\ContactController;
            return $ctrl->store($request);
        },
        'permission_callback' => function (WP_REST_Request $request) {
            // Vue側から送信される「X-WP-Nonce」ヘッダーの検証
            return wp_verify_nonce($request->get_header('X-WP-Nonce'), 'wp_rest');
        },
    ]);
});

// プラグインを呼び出すためのコードの設定
add_shortcode('myplugin_contact_form', function () {
    $ctrl = new MyPlugin\Controllers\ContactController;
    return $ctrl->create();
});

// 管理画面設定
add_action(
    'admin_menu',
    function () {
        add_menu_page(
            'お問い合わせ',
            'お問い合わせ',
            'manage_options',
            'contact-plugin',
            function () {
                $ctrl = new MyPlugin\Controllers\Admin\ContactController;
                if (isset($_GET['id'])) {
                    $ctrl->show((int) $_GET['id']);
                    return;
                }
                $ctrl->index();
            },
            'dashicons-email'
        );
    }
);

// CSS、JSの読み込み設定
add_action('wp_enqueue_scripts', function () {
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
