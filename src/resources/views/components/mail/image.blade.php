@if($asSection)
    <x-mail::content>
        <img {{ $attributes->merge(['class' => 'img' . ($isResponsive ? ' img--responsive' : '')]) }} src="{{ $src }}" width="{{ $width }}" height="{{ $height }}" border="0" alt="{{ $alt }}">
    </x-mail::content>
@else
    <img {{ $attributes->merge(['class' => 'img' . ($isResponsive ? ' img--responsive' : '')]) }} src="{{ $src }}" width="{{ $width }}" height="{{ $height }}" border="0" alt="{{ $alt }}">
@endif
