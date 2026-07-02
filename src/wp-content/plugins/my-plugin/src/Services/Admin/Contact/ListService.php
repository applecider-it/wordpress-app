<?php

namespace MyPlugin\Services\Admin\Contact;

use MyPlugin\Models\ContactMessage;

/**
 * お問い合わせ管理の一覧管理
 */
class ListService
{
    /** お問い合わせ一覧 */
    function getList()
    {
        global $wpdb;

        $table = ContactMessage::tableName();

        $rows = $wpdb->get_results(
            "SELECT * FROM {$table} ORDER BY created_at DESC"
        );

        return $rows;
    }
}
