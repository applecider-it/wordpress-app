<?php

namespace App\Services\Post;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * 投稿のAPI管理
 */
class ApiService
{
    /** 投稿一覧取得 */
    public function getPosts(int $page, int $perPage, ?int $searchCategory, string $search)
    {
        $baseUrl = config('myapp.cmsApiBaseUrl');

        $url = "{$baseUrl}/posts?page={$page}&per_page={$perPage}";
        if ($searchCategory) $url .= "&categories={$searchCategory}";
        if ($search) $url .= "&search={$search}";

        Log::info("getPosts url: {$url}");

        $response = Http::get($url);

        if ($response->failed()) {
            $error = $response->json();

            Log::info("getPosts error: " . $response->status(), $error);

            // ページ数がオーバーしたときは404
            if (($error['code'] ?? null) === 'rest_post_invalid_page_number') {
                throw new NotFoundHttpException;
            }

            throw new \Exception('getPostsでエラー');
        }

        $posts = $response->json();
        $totalPages = $response->header('X-WP-TotalPages');

        return compact('posts', 'totalPages');
    }

    /** 投稿取得 */
    public function getPost(string $slug)
    {
        $baseUrl = config('myapp.cmsApiBaseUrl');

        $url = $baseUrl . '/posts?slug=' . urlencode($slug);

        Log::info("getPost url: {$url}");

        $response = Http::get($url);

        if ($response->failed()) {
            $error = $response->json();

            Log::info("getPost error: " . $response->status(), $error);

            throw new \Exception('getPostでエラー');
        }

        $ret = $response->json();

        if (count($ret) === 0) throw new NotFoundHttpException;

        $detail = $ret[0];

        return $detail;
    }

    /** カテゴリー一覧取得 */
    public function getCategories()
    {
        $baseUrl = config('myapp.cmsApiBaseUrl');

        $url = "{$baseUrl}/categories";

        Log::info("getCategories url: {$url}");

        $response = Http::get($url);

        if ($response->failed()) {
            $error = $response->json();

            Log::info("getCategories error: " . $response->status(), $error);

            throw new \Exception('getCategoriesでエラー');
        }

        $categories = $response->json();

        return $categories;
    }
}
