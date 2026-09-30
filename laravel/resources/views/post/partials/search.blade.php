<div class="my-3">
    <form action="{{ route('post.index') }}">
        @include('post.partials.search-hidden', ['exclude' => 'search'])
        <input type="text" name="search" value="{{ $search }}" class="border p-2" />
        <input type="submit" alue="検索" class="border p-2" />
    </form>
</div>

<div class="my-3">
    @foreach ($hashedCategories as $category)
        <a class="inline-block mr-2 text-sm {{ $searchCategory == $category['id'] ? 'text-blue-400' : '' }}"
        href="{{ route('post.index') }}?{{ http_build_query(['category' => $category['id']] + $params) }}">{{ $category['name'] }}</a>
    @endforeach

    @if($searchCategory)
        <a class="inline-block ml-5 text-sm"
        href="{{ route('post.index') }}?{{ http_build_query(['category' => null] + $params) }}">絞り込み解除</a>
    @endif
</div>