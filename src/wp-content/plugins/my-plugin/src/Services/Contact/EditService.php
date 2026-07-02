<?php

namespace MyPlugin\Services\Contact;

use MyPlugin\Models\ContactMessage;

/**
 * お問い合わせの登録管理
 */
class EditService
{
    /** お問い合わせ登録 */
    function store(array $data)
    {
        global $wpdb;

        $wpdb->insert(
            ContactMessage::tableName(),
            array(
                'name' => sanitize_text_field($data['name']),
                'email' => sanitize_email($data['email']),
                'subject' => sanitize_text_field($data['subject']),
                'message' => sanitize_textarea_field($data['message']),
            )
        );
    }
}
