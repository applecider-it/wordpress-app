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
require_once __DIR__ . '/src/Form.php';
require_once __DIR__ . '/src/Submit.php';
require_once __DIR__ . '/src/Admin.php';

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

            $submit = new MyPlugin\Submit;

            $submit->store_contact();
        }
    }
});

// プラグインを呼び出すためのコードの設定
add_shortcode('contact_form', function () {
    $form = new MyPlugin\Form;

    return $form->render();
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
                $admin = new MyPlugin\Admin;

                $admin->output();
            },
            'dashicons-email'
        );
    }
);
