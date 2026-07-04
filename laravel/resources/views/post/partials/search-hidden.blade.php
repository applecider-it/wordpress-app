@foreach ($params as $key => $val)
    @if($key === $exclude)
      @continue
    @endif
    <input type="hidden" name="{{ $key }}" value="{{ $val }}" />
@endforeach