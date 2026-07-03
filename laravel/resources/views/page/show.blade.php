@extends('layouts.app')

@section('content')

<div class="mx-auto max-w-4xl px-6 py-12">

    <article class="rounded-2xl bg-white p-8 shadow-md">

        <header class="mb-8 border-b border-gray-200 pb-6">
            <h1 class="text-4xl font-bold leading-tight text-gray-900">
                {{ $detail['title']['rendered'] }}
            </h1>
        </header>

        <div class="prose prose-lg max-w-none app-post-content-container">
            {!! $detail['content']['rendered'] !!}
        </div>

    </article>

    <div class="mt-8">
        <a
            href="{{ route('page.index') }}"
            class="inline-flex items-center rounded-lg border border-gray-300 px-5 py-2.5 text-gray-700 transition hover:bg-gray-100"
        >
            ← 固定ページ一覧へ戻る
        </a>
    </div>

</div>

@endsection