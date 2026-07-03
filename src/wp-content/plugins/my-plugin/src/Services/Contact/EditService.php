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
                'name' => $data['name'],
                'email' => $data['email'],
                'subject' => $data['subject'],
                'message' => $data['message'],
            )
        );
    }
}
