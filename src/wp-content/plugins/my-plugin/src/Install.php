<?php

namespace MyPlugin;

class Install
{
    /** インストール実行 */
    function exec()
    {
        global $wpdb;

        $table = $wpdb->prefix . 'myplugin_contact_messages';

        // 文字コード取得
        $charset = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(255) NOT NULL,
            subject VARCHAR(255),
            message TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        ) $charset;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        // 差分だけ反映
        dbDelta($sql);
    }
}
