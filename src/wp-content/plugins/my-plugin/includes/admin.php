<?php

function cp_admin_menu() {

    add_menu_page(
        'お問い合わせ',
        'お問い合わせ',
        'manage_options',
        'contact-plugin',
        'cp_admin_page',
        'dashicons-email'
    );

}

function cp_admin_page() {

    global $wpdb;

    $rows = $wpdb->get_results(
        "SELECT * FROM {$wpdb->prefix}contact_messages ORDER BY created_at DESC"
    );

    echo "<div class='wrap'>";
    echo "<h1>お問い合わせ一覧</h1>";

    echo "<table class='widefat striped'>";

    echo "<tr>
            <th>ID</th>
            <th>日時</th>
            <th>名前</th>
            <th>メール</th>
            <th>件名</th>
          </tr>";

    foreach ($rows as $row) {

        echo "<tr>";

        echo "<td>{$row->id}</td>";
        echo "<td>{$row->created_at}</td>";
        echo "<td>".esc_html($row->name)."</td>";
        echo "<td>".esc_html($row->email)."</td>";
        echo "<td>".esc_html($row->subject)."</td>";

        echo "</tr>";
    }

    echo "</table>";

    echo "</div>";
}