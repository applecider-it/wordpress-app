<?php

function cp_contact_form() {

    ob_start();
?>

<form method="post">

    <?php wp_nonce_field('contact_form'); ?>

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
        <input type="text" name="subject">
    </p>

    <p>
        内容<br>
        <textarea name="message" rows="6"></textarea>
    </p>

    <button type="submit" name="contact_submit">
        送信
    </button>

</form>

<?php

    return ob_get_clean();
}