<?php

namespace MyPlugin\Controllers;

use MyPlugin\Services\Output\View;
use MyPlugin\Services\Contact\EditService;

use MyPlugin\Models\ContactMessage;

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
        $name    = ContactMessage::sanitizeName($request->get_param('name'));
        $email   = ContactMessage::sanitizeEmail($request->get_param('email'));
        $subject = ContactMessage::sanitizeSubject($request->get_param('subject'));
        $message = ContactMessage::sanitizeMessage($request->get_param('message'));

        // バリデーション
        $errors = [];
        $val = ContactMessage::validationName($name); if ($val) $errors['name'] = $val;
        $val = ContactMessage::validationEmail($email); if ($val) $errors['email'] = $val;
        $val = ContactMessage::validationSubject($subject); if ($val) $errors['subject'] = $val;
        $val = ContactMessage::validationMessage($message); if ($val) $errors['message'] = $val;

        $data = compact('name', 'email', 'subject', 'message');

        return compact('errors', 'data');
    }

}
