<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\Post\ApiService;

class PostController extends Controller
{
    function  __construct(private ApiService $apiService) {}

    /** 投稿一覧 */
    public function index()
    {
        $page = request('page', 1);
        $searchCategory = request('category', null);
        $search = request('search', '');
        $perPage = 5;

        $data = $this->apiService->getPosts($page, $perPage, $searchCategory, $search);

        $categories = $this->apiService->getCategories();
        $hashedCategories = array_column($categories, null, 'id');

        $params = request()->all();
        unset($params['page']);

        return view('post.index', $data + compact(
            'page',
            'hashedCategories',
            'params',
            'searchCategory',
            'search',
        ));
    }

    /** 投稿詳細 */
    public function show(string $slug)
    {
        $detail = $this->apiService->getPost($slug);

        return view('post.show', compact('detail'));
    }
}
