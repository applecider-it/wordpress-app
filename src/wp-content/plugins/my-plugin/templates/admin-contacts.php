<?php

/** @var array $data */
?>

<div class='wrap'>
    <h1>お問い合わせ一覧</h1>

    <table class='widefat striped'>
        <tr>
            <th>ID</th>
            <th>日時</th>
            <th>名前</th>
            <th>メール</th>
            <th>件名</th>
        </tr>

        <?php foreach ($data['rows'] as $row): ?>
            <tr>
                <td><?= esc_html($row->id) ?></td>
                <td><?= esc_html($row->created_at) ?></td>
                <td><?= esc_html($row->name) ?></td>
                <td><?= esc_html($row->email) ?></td>
                <td>
                    <a href="<?= admin_url('admin.php?page=contact-plugin&id=' . $row->id) ?>">
                        <?= esc_html($row->subject) ?>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

</div>