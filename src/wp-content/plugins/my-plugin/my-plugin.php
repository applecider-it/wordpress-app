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

require_once __DIR__ . '/src/Install.php';
require_once __DIR__ . '/src/View.php';

require_once __DIR__ . '/src/Controllers/ContactController.php';
require_once __DIR__ . '/src/Controllers/AdminContactController.php';

// プラグイン追加時に動作する処理
register_activation_hook(__FILE__, function () {
    $install = new MyPlugin\Install;

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

            $contact = new MyPlugin\Controllers\ContactController;

            $contact->store();
        }
    }
});

// プラグインを呼び出すためのコードの設定
add_shortcode('contact_form', function () {
    $contact = new MyPlugin\Controllers\ContactController;

    return $contact->create();
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
                $adminContact = new MyPlugin\Controllers\AdminContactController;
                if (isset($_GET['id'])) {
                    $adminContact->show((int) $_GET['id']);
                    return;
                }
                $adminContact->index();
            },
            'dashicons-email'
        );
    }
);
