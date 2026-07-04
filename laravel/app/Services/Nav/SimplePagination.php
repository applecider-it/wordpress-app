<?php

namespace App\Services\Nav;

/**
 * シンプルな改ページ管理
 */
class SimplePagination
{
    public function __construct(
        public int $total,
        public int $totalPages,
        public int $page,
        public array $params,
    ) {}
}
