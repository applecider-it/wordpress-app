<?php

function cp_save_contact() {

    if (!isset($_POST['contact_submit'])) {
        return;
    }

    check_admin_referer('contact_form');

    global $wpdb;

    $wpdb->insert(
        $wpdb->prefix . 'contact_messages',
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
