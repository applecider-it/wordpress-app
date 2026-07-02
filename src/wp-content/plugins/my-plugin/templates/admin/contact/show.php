<?php

/** @var array $data */

$row = $data['row'];
?>

<div class="wrap">

    <h1>お問い合わせ詳細</h1>

    <table class="form-table">

        <tr>
            <th>ID</th>
            <td><?= esc_html($row->id) ?></td>
        </tr>

        <tr>
            <th>件名</th>
            <td><?= esc_html($row->subject) ?></td>
        </tr>

        <tr>
            <th>名前</th>
            <td><?= esc_html($row->name) ?></td>
        </tr>

        <tr>
            <th>メール</th>
            <td><?= esc_html($row->email) ?></td>
        </tr>

        <tr>
            <th>内容</th>
            <td><?= nl2br(esc_html($row->message)) ?></td>
        </tr>

        <tr>
            <th>受付日時</th>
            <td><?= esc_html($row->created_at) ?></td>
        </tr>

    </table>

    <p>
        <a class="button" href="<?= admin_url('admin.php?page=contact-plugin') ?>">
            一覧へ戻る
        </a>
    </p>

</div>