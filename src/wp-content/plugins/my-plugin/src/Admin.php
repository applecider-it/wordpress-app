<?php

namespace MyPlugin;

class Admin
{
    function output()
    {
        global $wpdb;

        $rows = $wpdb->get_results(
            "SELECT * FROM {$wpdb->prefix}myplugin_contact_messages ORDER BY created_at DESC"
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
            <th>内容</th>
          </tr>";

        foreach ($rows as $row) {

            echo "<tr>";

            echo "<td>{$row->id}</td>";
            echo "<td>{$row->created_at}</td>";
            echo "<td>" . esc_html($row->name) . "</td>";
            echo "<td>" . esc_html($row->email) . "</td>";
            echo "<td>" . esc_html($row->subject) . "</td>";
            echo "<td>" . esc_html($row->message) . "</td>";

            echo "</tr>";
        }

        echo "</table>";

        echo "</div>";
    }
}
