<?php

namespace App\Services\Page;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

            Log::info("getPages error: " . $response->status(), $error);

            // ページ数がオーバーしたときは404
            if (($error['code'] ?? null) === 'rest_post_invalid_page_number') {
                throw new NotFoundHttpException;
            }

            throw new \Exception('getPagesでエラー');
        }

        $pages = $response->json();
        $totalPages = $response->header('X-WP-TotalPages');
        $total = $response->header('X-WP-Total');

        return compact('pages', 'totalPages', 'total');
    }

    /** 固定ページ取得 */
    public function getPage(string $slug)
    {
        $baseUrl = config('myapp.cmsApiBaseUrl');

        $url = $baseUrl . '/pages?slug=' . urlencode($slug);

        Log::info("getPage url: {$url}");

        $response = Http::get($url);

        if ($response->failed()) {
            $error = $response->json();

            Log::info("getPage error: " . $response->status(), $error);

            throw new \Exception('getPageでエラー');
        }

        $ret = $response->json();

        if (count($ret) === 0) throw new NotFoundHttpException;

        $detail = $ret[0];

        return $detail;
    }
}
