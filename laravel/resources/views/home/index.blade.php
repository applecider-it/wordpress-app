@extends('layouts.app')

@section('content')

<div>
    <h2>
        投稿一覧
    </h2>
</div>

<div>

    @foreach ($posts as $post)

        <div>
            {{ $post['title']['rendered'] }}

            <a href="{{ route('home.detail', ['slug' => $post['slug']]) }}">詳細</a>
        </div>

    @endforeach

</div>

@endsection