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
    public function store(\WP_REST_Request $request)
    {
        $ret = $this->storeValidation($request);
        $errors = $ret['errors'];
        $data = $ret['data'];

        if (!empty($errors)) {
            return new \WP_REST_Response(['errors' => $errors], 422);
        }

        $editService = new EditService;
        $editService->store($data);

        return new \WP_REST_Response(['status' => 'ok'], 200);
    }

    /** お問い合わせ登録バリデーション */
    private function storeValidation(\WP_REST_Request $request)
    {
        $name    = sanitize_text_field($request->get_param('name'));
        $email   = sanitize_email($request->get_param('email'));
        $subject = sanitize_text_field($request->get_param('subject'));
        $message = sanitize_textarea_field($request->get_param('message'));

        // バリデーション
        $errors = [];
        if (empty($name))    $errors['name']    = '名前は必須です';
        if (!is_email($email)) $errors['email']   = '正しいメールアドレスを入力してください';
        if (empty($subject)) $errors['subject'] = '件名は必須です';
        if (empty($message)) $errors['message'] = '内容は必須です';

        $data = compact('name', 'email', 'subject', 'message');

        return compact('errors', 'data');
    }

}
