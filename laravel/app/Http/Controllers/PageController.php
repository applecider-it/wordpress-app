<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\Page\ApiService;
use App\Services\Nav\SimplePagination;

class PageController extends Controller
{
    function  __construct(private ApiService $apiService) {}

    /** 固定ページ一覧 */
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = 2;

        $data = $this->apiService->getPages($page, $perPage);

        $pages = $data['pages'];

        $pagination = new SimplePagination(
            $data['total'],
            $data['totalPages'],
            $page,
            [],
        );

        return view('page.index', compact('pages', 'pagination'));
    }

    /** 固定ページ詳細 */
    public function show(string $slug)
    {
        $page = $this->apiService->getPage($slug);

        return view('page.show', compact('page'));
    }
}
