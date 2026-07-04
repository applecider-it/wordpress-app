<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\Page\ApiService;

class PageController extends Controller
{
    function  __construct(private ApiService $apiService) {}

    /** 固定ページ一覧 */
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = 2;

        $data = $this->apiService->getPages($page, $perPage);

        return view('page.index', $data + compact('page'));
    }

    /** 固定ページ詳細 */
    public function show(string $slug)
    {
        $detail = $this->apiService->getPage($slug);

        return view('page.show', compact('detail'));
    }
}
