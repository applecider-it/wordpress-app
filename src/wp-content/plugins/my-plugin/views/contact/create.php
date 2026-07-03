<script src="<?= plugins_url('assets/js/contact/contact-form.js', dirname(__DIR__)) . '?' .
                    filemtime(dirname(dirname(__DIR__)) . '/assets/js/contact/contact-form.js') ?>"></script>

<script type="module">
    const {
        createApp
    } = window.Vue;

    createApp(MypluginContactForm, {
        wpNonce: '<?php echo wp_create_nonce("wp_rest"); ?>',
        url: '<?php echo esc_url_raw(rest_url("myplugin/contact")); ?>'
    }).mount('#my-contact-app');
</script>

<div id="my-contact-app"></div>