@extends('layouts.app')

@section('content')

<div class="mx-auto max-w-5xl px-6 py-12">
    <div class="mb-10">
        <h1 class="text-4xl font-bold text-gray-900">
            固定ページ
        </h1>
    </div>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($pages as $page)
            <article class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <h2 class="mb-4 line-clamp-2 text-xl font-semibold text-gray-800">
                    {{ $page['title']['rendered'] }}
                </h2>

                <div class="flex justify-end">
                    <a
                        href="{{ route('page.show', ['slug' => $page['slug']]) }}"
                        class="app-btn-primary"
                    >
                        詳細を見る
                        <span>→</span>
                    </a>
                </div>
            </article>
        @endforeach
    </div>

    @include('partials.nav.simple-pagination', ['pagination' => $pagination])
</div>

@endsection