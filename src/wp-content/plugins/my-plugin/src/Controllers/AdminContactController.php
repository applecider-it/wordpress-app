<?php

namespace MyPlugin\Controllers;

use MyPlugin\View;

/**
 * お問い合わせ管理画面
 */
class AdminContactController
{
    /** 一覧 */
    function index()
    {
        global $wpdb;

        $rows = $wpdb->get_results(
            "SELECT * FROM {$wpdb->prefix}myplugin_contact_messages ORDER BY created_at DESC"
        );

        $view = new View;
        echo $view->render('admin-contacts', compact('rows'));
    }

    /** 詳細 */
    function show(int $id)
    {
        global $wpdb;

        $table = $wpdb->prefix . 'myplugin_contact_messages';

        $row = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM {$table} WHERE id = %d",
                $id
            )
        );

        if (!$row) {
            wp_die('データがありません。');
        }

        $view = new View;
        echo $view->render('admin-contact', compact('row'));
    }
}
