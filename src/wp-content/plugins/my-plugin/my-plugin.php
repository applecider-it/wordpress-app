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

// アクセスのたびに動作する初期化処理
add_action('init', function () {
    // ルート設定
    if (isset($_POST['myplugin_action'])) {
        // 登録処理
        if ($_POST['myplugin_action'] === 'store_contact') {
            // 不正リクエストチェック
            check_admin_referer('myplugin_contact_form');

            $ctrl = new MyPlugin\Controllers\ContactController;
            $ctrl->store();
        }
    }
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
