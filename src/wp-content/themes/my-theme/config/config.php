<?php

$img = get_template_directory_uri() . '/assets/image/sample.svg';

return [
    'front-page' => [
        'slideList1' => [$img, $img, $img, $img,],
        'slideList2' => [$img, $img,],
    ],
    'vite' => [
        'dev' => WP_DEBUG,
        'port' => 8081,
    ]
];
