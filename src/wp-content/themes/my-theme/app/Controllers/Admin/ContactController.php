<?php

namespace MyApp\Controllers\Admin;

use MyApp\Services\Web\View;
use MyApp\Services\Admin\Contact\ListService;

use MyApp\Models\ContactMessage;

/**
 * お問い合わせ管理画面
 */
class ContactController
{
    /** 一覧 */
    public function index()
    {
        $listService = new ListService;
        $rows = $listService->getList();

        $view = new View;
        echo $view->render('admin/contact/index', compact('rows'));
    }

    /** 詳細 */
    public function show(int $id)
    {
        $row = ContactMessage::find($id);

        if (!$row) {
            wp_die('データがありません。');
        }

        $view = new View;
        echo $view->render('admin/contact/show', compact('row'));
    }
}
