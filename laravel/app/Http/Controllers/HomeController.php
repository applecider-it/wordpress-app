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
        $url = 'http://localhost:8080/wp-json/wp/v2/posts';

        $json = file_get_contents($url);

        $posts = json_decode($json, true);

        return view('home.index', compact('posts'));
    }

    /** 投稿詳細 */
    public function detail(string $slug)
    {
        $url = 'http://localhost:8080/wp-json/wp/v2/posts?slug=' . urlencode($slug);

        $json = file_get_contents($url);

        $ret = json_decode($json, true);

        $detail = $ret[0];

        return view('home.detail', compact('detail'));
    }
}
