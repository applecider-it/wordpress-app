<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\Post\ApiService;
use App\Services\Nav\SimplePagination;

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

        $data = $this->apiService->getPosts(
            $page,
            $perPage,
            $searchCategory,
            $search
        );

        $posts = $data['posts'];

        $categories = $this->apiService->getCategories();
        $hashedCategories = array_column($categories, null, 'id');

        $params = request()->all();
        unset($params['page']);

        $pagination = new SimplePagination(
            $data['total'],
            $data['totalPages'],
            $page,
            $params,
        );

        return view('post.index', compact(
            'posts',
            'pagination',
            'hashedCategories',
            'params',
            'searchCategory',
            'search',
        ));
    }

    /** 投稿詳細 */
    public function show(string $slug)
    {
        $post = $this->apiService->getPost($slug);

        $categories = $this->apiService->getCategories();
        $hashedCategories = array_column($categories, null, 'id');

        return view('post.show', compact(
            'post',
            'hashedCategories'
        ));
    }
}
