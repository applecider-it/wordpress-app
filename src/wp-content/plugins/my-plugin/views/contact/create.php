<script type="module" src="<?= MyApp\Vite::getUrl('resources/js/entrypoints/contact-form.js') ?>"></script>

<div id="my-contact-app"
    data-all="<?= esc_html(json_encode([
                    'wpNonce' => wp_create_nonce("wp_rest"),
                    'url' => esc_url_raw(rest_url("myplugin/contact")),
                ])) ?>"></div>