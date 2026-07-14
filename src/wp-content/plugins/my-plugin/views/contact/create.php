<?php

use Myapp\App;

$vite = App::get('vite');
?>

<?= $vite->importJs('resources/js/entrypoints/contact-form.ts') ?>

<div id="my-contact-app"
    data-all="<?= esc_html(json_encode([
                    'wpNonce' => wp_create_nonce("wp_rest"),
                    'url' => esc_url_raw(rest_url("myplugin/contact")),
                ])) ?>"></div>