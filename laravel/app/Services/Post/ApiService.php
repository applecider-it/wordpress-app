<?php

namespace App\Services\Post;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * 投稿のAPI管理
 */
class ApiService
{
    /** 投稿一覧取得 */
    public function getPosts(int $page, int $limit)
    {
        $baseUrl = config('myapp.cmsApiBaseUrl');

        $url = "{$baseUrl}/posts?page={$page}&per_page={$limit}";

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

        return compact('posts', 'page', 'totalPages');
    }

    /** 投稿取得 */
    public function getPost(string $slug)
    {
        $baseUrl = config('myapp.cmsApiBaseUrl');

        $url = $baseUrl . '/posts?slug=' . urlencode($slug);

        Log::info("getPost url: {$url}");

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
