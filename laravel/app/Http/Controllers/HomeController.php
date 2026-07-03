<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * ホームコントローラー
 */
class HomeController extends Controller
{
    /** 投稿一覧 */
    public function index()
    {
        return view('home.index');
    }
}
