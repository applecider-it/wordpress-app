@if($pagination->totalPages > 0)
    <div class="mt-10 flex items-center justify-center gap-4">

        @if($pagination->page > 1)
            <a
                href="?{{ http_build_query(['page' => $pagination->page - 1] + $pagination->params) }}"
                class="rounded-lg border border-gray-300 px-4 py-2 text-gray-700 transition hover:bg-gray-100"
            >
                ← 前へ
            </a>
        @else
            <span
                class="cursor-not-allowed rounded-lg border border-gray-200 px-4 py-2 text-gray-400"
            >
                ← 前へ
            </span>
        @endif

        <span class="text-sm font-medium text-gray-600">
            {{ $pagination->total }}件
            ( {{ $pagination->page }} / {{ $pagination->totalPages }} )
        </span>

        @if($pagination->page < $pagination->totalPages)
            <a
                href="?{{ http_build_query(['page' => $pagination->page + 1] + $pagination->params) }}"
                class="rounded-lg bg-blue-600 px-4 py-2 text-white transition hover:bg-blue-700"
            >
                次へ →
            </a>
        @else
            <span
                class="cursor-not-allowed rounded-lg bg-gray-200 px-4 py-2 text-gray-400"
            >
                次へ →
            </span>
        @endif

    </div>
@endif