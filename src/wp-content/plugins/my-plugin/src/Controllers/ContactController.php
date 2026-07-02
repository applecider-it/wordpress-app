<?php

namespace MyPlugin\Controllers;

use MyPlugin\View;

/**
 * お問い合わせ管理
 */
class ContactController
{
    /** お問い合わせフォーム */
    function create()
    {
        $view = new View;
        return $view->render('contact-form');
    }

    /** お問い合わせ登録 */
    function store()
    {
        global $wpdb;

        $wpdb->insert(
            $wpdb->prefix . 'myplugin_contact_messages',
            array(
                'name' => sanitize_text_field($_POST['name']),
                'email' => sanitize_email($_POST['email']),
                'subject' => sanitize_text_field($_POST['subject']),
                'message' => sanitize_textarea_field($_POST['message']),
            )
        );

        wp_redirect(add_query_arg('success', 1, wp_get_referer()));
        exit;
    }
}
