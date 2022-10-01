<a {{ $attributes->merge(['class' => 'button btn-' . $color]) }}  href="{{ $url }}" rel="noopener" target="_blank" style="width: {{ $width . 'px' }}; height: {{ $height . 'px' }};">
    {!! $slot != '' ? $slot : $title !!}
</a>
