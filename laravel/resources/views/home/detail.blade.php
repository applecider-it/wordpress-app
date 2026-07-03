@extends('layouts.app')

@section('content')

<div>
    <h2>
        {{ $detail['title']['rendered'] }}
    </h2>
</div>

<div>

        <div>
            {!! $detail['content']['rendered'] !!}
        </div>

</div>

@endsection