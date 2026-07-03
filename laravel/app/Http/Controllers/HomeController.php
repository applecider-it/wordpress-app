<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

/**
 * ホームコントローラー
 */
class HomeController extends Controller
{
    /** 投稿一覧 */
    public function index()
    {
        $page = request('page', 1);
        $limit = 5;

        $url = "http://localhost:8080/wp-json/wp/v2/posts?page={$page}&per_page={$limit}";

        $response = Http::get($url);

        $posts = $response->json();
        $totalPages = $response->header('X-WP-TotalPages');

        return view('home.index', compact('posts', 'page', 'totalPages'));
    }

    /** 投稿詳細 */
    public function detail(string $slug)
    {
        $url = 'http://localhost:8080/wp-json/wp/v2/posts?slug=' . urlencode($slug);

        $response = Http::get($url);

        $ret = $response->json();

        if (count($ret) === 0) abort(404);

        $detail = $ret[0];

        return view('home.detail', compact('detail'));
    }
}
