<?php

namespace MyPlugin\Models;

/**
 * お問い合わせ
 */
class ContactMessage
{
    /** テーブル名 */
    public static function tableName()
    {
        global $wpdb;

        return $wpdb->prefix . 'myplugin_contact_messages';
    }

    /** 取得 */
    public static function find(int $id)
    {
        global $wpdb;

        $table = self::tableName();

        $row = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM {$table} WHERE id = %d",
                $id
            )
        );

        return $row;
    }
}
