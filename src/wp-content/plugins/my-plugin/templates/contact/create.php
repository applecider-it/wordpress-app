<form method="post">

    <?php wp_nonce_field('myplugin_contact_form'); ?>

    <input type="hidden" name="myplugin_action" value="store_contact">

    <div class="space-y-3">
        <div>
            <div>名前</div>
            <div><input type="text" name="name" class="app-form-input" required></div>
        </div>

        <div>
            <div>メール</div>
            <div><input type="email" name="email" class="app-form-input" required></div>
        </div>

        <div>
            <div>件名</div>
            <div><input type="text" name="subject" class="app-form-input" required></div>
        </div>

        <div>
            <div>内容</div>
            <div><textarea name="message" rows="6" class="app-form-input" required></textarea></div>
        </div>
    </div>

    <div class="mt-5">
        <button type="submit" class="app-btn-primary">
            送信
        </button>
    </div>

</form>