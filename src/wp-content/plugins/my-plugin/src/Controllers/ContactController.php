<?php

namespace MyPlugin\Controllers;

use MyPlugin\Services\Output\View;
use MyPlugin\Services\Contact\EditService;

/**
 * お問い合わせ管理
 */
class ContactController
{
    /** お問い合わせフォーム */
    function create()
    {
        $view = new View;
        return $view->render('contact/create');
    }

    /** お問い合わせ登録 */
    function store()
    {
        $editService = new EditService;
        $editService->store($_POST);

        wp_redirect(add_query_arg('success', 1, wp_get_referer()));
        exit;
    }
}
