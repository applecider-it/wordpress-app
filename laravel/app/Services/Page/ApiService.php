<?php

namespace App\Services\Page;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * 固定ページのAPI管理
 */
class ApiService
{
    /** 固定ページ一覧取得 */
    public function getPages(int $page, int $perPage)
    {
        $baseUrl = config('myapp.cmsApiBaseUrl');

        $url = "{$baseUrl}/pages?page={$page}&per_page={$perPage}";

        Log::info("getPosts url: {$url}");

        $response = Http::get($url);

        if ($response->failed()) {
            $error = $response->json();

            // ページ数がオーバーしたときは404
            if (($error['code'] ?? null) === 'rest_post_invalid_page_number') {
                abort(404);
            }

            abort($response->status());
        }

        $posts = $response->json();
        $totalPages = $response->header('X-WP-TotalPages');

        return compact('posts', 'totalPages');
    }

    /** 固定ページ取得 */
    public function getPage(string $slug)
    {
        $baseUrl = config('myapp.cmsApiBaseUrl');

        $url = $baseUrl . '/pages?slug=' . urlencode($slug);

        Log::info("getPage url: {$url}");

        $response = Http::get($url);

        if ($response->failed()) {
            abort($response->status());
        }

        $ret = $response->json();

        if (count($ret) === 0) abort(404);

        $detail = $ret[0];

        return $detail;
    }
}
