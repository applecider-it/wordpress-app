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

require_once __DIR__ . '/includes/install.php';
require_once __DIR__ . '/includes/form.php';
require_once __DIR__ . '/includes/submit.php';
require_once __DIR__ . '/includes/admin.php';

register_activation_hook(__FILE__, 'cp_install');

add_shortcode('contact_form', 'cp_contact_form');

add_action('admin_menu', 'cp_admin_menu');

add_action('init', function () {
    cp_save_contact();
});
