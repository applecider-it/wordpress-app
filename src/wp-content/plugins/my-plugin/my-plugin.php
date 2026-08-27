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

require_once WP_CONTENT_DIR . '/themes/my-theme/bootstrap/app.php';

require_once WP_CONTENT_DIR . '/themes/my-theme/bootstrap/plugin.php';
