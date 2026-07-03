<script src="<?= plugins_url('assets/js/contact-form.js', dirname(__DIR__)) . '?' . filemtime(dirname(dirname(__DIR__)) . '/assets/js/contact-form.js') ?>"></script>

<script type="module">
    const {
        createApp
    } = window.Vue;

    // WordPressが発行する REST API 用の Nonce
    const wpNonce = '<?php echo wp_create_nonce("wp_rest"); ?>';
    const url = '<?php echo esc_url_raw(rest_url("myplugin/contact")); ?>';

    createApp(MypluginContactForm, {
        wpNonce,
        url
    }).mount('#my-contact-app');
</script>

<div id="my-contact-app"></div>