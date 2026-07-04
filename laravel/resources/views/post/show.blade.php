@extends('layouts.app')

@section('content')

<div class="mx-auto max-w-4xl px-6 py-12">

    <article class="rounded-2xl bg-white p-8 shadow-md">

        <header class="mb-8 border-b border-gray-200 pb-6">
            <h1 class="text-4xl font-bold leading-tight text-gray-900">
                {{ $post['title']['rendered'] }}
            </h1>

            <div class="mt-3">
                @foreach ($post['categories'] as $categoryId)
                    <a href="{{ route('post.index') }}?category={{ $categoryId }}" class="inline-block mr-2 text-xs">{{ $hashedCategories[$categoryId]['name'] }}</a>
                @endforeach
            </div>
        </header>

        <div class="prose prose-lg max-w-none app-post-content-container">
            {!! $post['content']['rendered'] !!}
        </div>

    </article>

    <div class="mt-8">
        <a
            href="{{ route('post.index') }}"
            class="inline-flex items-center rounded-lg border border-gray-300 px-5 py-2.5 text-gray-700 transition hover:bg-gray-100"
        >
            ← 投稿一覧へ戻る
        </a>
    </div>

</div>

@endsection