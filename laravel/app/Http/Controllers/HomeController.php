<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\Post\ApiService;

/**
 * ホームコントローラー
 */
class HomeController extends Controller
{
    function  __construct(private ApiService $apiService) {}

    /** 投稿一覧 */
    public function index()
    {
        $page = request('page', 1);
        $limit = 5;

        $data = $this->apiService->getPosts($page, $limit);

        return view('home.index', $data);
    }

    /** 投稿詳細 */
    public function detail(string $slug)
    {
        $detail = $this->apiService->getPost($slug);

        return view('home.detail', compact('detail'));
    }
}
