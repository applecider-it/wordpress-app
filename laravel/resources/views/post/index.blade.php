@extends('layouts.app')

@section('content')

<div class="mx-auto max-w-5xl px-6 py-12">
    <div class="mb-10">
        <h1 class="text-4xl font-bold text-gray-900">
            投稿一覧
        </h1>
        <p class="mt-2 text-gray-500">
            最新の記事をご覧いただけます。
        </p>
    </div>

    <div class="my-3">
        <form action="{{ route('post.index') }}">
            @include('post.partials.search-hidden')
            <input type="text" name="search" value="{{ $search }}" class="border p-2" />
            <input type="submit" alue="検索" class="border p-2" />
        </form>
    </div>

    <div class="my-3">
        @foreach ($hashedCategories as $category)
            <a class="inline-block mr-2 text-sm {{ $searchCategory == $category['id'] ? 'text-blue-400' : '' }}"
            href="{{ route('post.index') }}?{{ http_build_query(['category' => $category['id']] + $params) }}">{{ $category['name'] }}</a>
        @endforeach
    </div>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($posts as $post)
            <article class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <h2 class="mb-4 line-clamp-2 text-xl font-semibold text-gray-800">
                    {{ $post['title']['rendered'] }}
                </h2>

                <div class="flex justify-end">
                    <a
                        href="{{ route('post.show', ['slug' => $post['slug']]) }}"
                        class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-700"
                    >
                        詳細を見る
                        <span>→</span>
                    </a>
                </div>

                <div>
                    @foreach ($post['categories'] as $category)
                        <span class="inline-block mr-2 text-xs">{{ $hashedCategories[$category]['name'] }}</span>
                    @endforeach
                </div>
            </article>
        @endforeach
    </div>

    @include('partials.nav.simple-pagination', compact('page', 'totalPages', 'params'))
</div>

@endsection