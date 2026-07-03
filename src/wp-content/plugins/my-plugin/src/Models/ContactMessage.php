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

    /** 名前のサニタイズ */
    public static function sanitizeName(mixed $value)
    {
        return sanitize_text_field($value);
    }
    /** 名前のバリデーション */
    public static function validationName(mixed $value)
    {
        $errors = [];
        if (empty($value)) $errors[] = '名前は必須です';
        return $errors;
    }

    /** メールアドレスのサニタイズ */
    public static function sanitizeEmail(mixed $value)
    {
        return sanitize_email($value);
    }
    /** メールアドレスのバリデーション */
    public static function validationEmail(mixed $value)
    {
        $errors = [];
        if (!is_email($value)) $errors[] = '正しいメールアドレスを入力してください';
        return $errors;
    }

    /** 件名のサニタイズ */
    public static function sanitizeSubject(mixed $value)
    {
        return sanitize_text_field($value);
    }
    /** 件名のバリデーション */
    public static function validationSubject(mixed $value)
    {
        $errors = [];
        if (empty($value)) $errors[] = '件名は必須です';
        return $errors;
    }

    /** 内容のサニタイズ */
    public static function sanitizeMessage(mixed $value)
    {
        return sanitize_textarea_field($value);
    }
    /** 内容のバリデーション */
    public static function validationMessage(mixed $value)
    {
        $errors = [];
        if (empty($value)) $errors[] = '内容は必須です';
        return $errors;
    }
}
