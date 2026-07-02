<form method="post">

    <?php wp_nonce_field('myplugin_contact_form'); ?>

    <input type="hidden" name="myplugin_action" value="store_contact">

    <p>
        名前<br>
        <input type="text" name="name" required>
    </p>

    <p>
        メール<br>
        <input type="email" name="email" required>
    </p>

    <p>
        件名<br>
        <input type="text" name="subject" required>
    </p>

    <p>
        内容<br>
        <textarea name="message" rows="6" required></textarea>
    </p>

    <button type="submit">
        送信
    </button>

</form>