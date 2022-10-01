<tr>
    <td align="center" valign="top">
        <table class="hero" height="{{ $height }}" cellpadding="0" cellspacing="0" border="0" background="{{ $background }}" bgcolor="{{ $background }}" style="background-image: url({{ $background }}); background-color: {{ $background }};">
            <x-mail::new-line />
            <tr>
                <td align="center">
                    <table cellpadding="0" cellspacing="0" border="0" class="hero__container">
                        @isset ($title)
                            <tr>
                                <td align="center" class="hero__title">
                                    @if(is_string($title))
                                        <h1>{!! $title !!}</h1>
                                    @else
                                        {!! $title !!}
                                    @endif
                                </td>
                            </tr>
                        @endisset


                        @isset($subtitle)
                            @if($title)
                                <x-mail::new-line />
                            @endif
                            <tr>
                                <td align="center" class="hero__subtitle">
                                    @if(is_string($subtitle))
                                        <p>{!! $subtitle !!}</p>
                                    @else
                                        {!! $subtitle !!}
                                    @endif
                                </td>
                            </tr>
                        @endisset

                        @isset($button)
                            @if($title || $subtitle)
                                <x-mail::new-line />
                            @endif

                            @if(is_string($button))
                                <tr>
                                    <td class="hero__button" align="center">
                                        <x-mail::button title="{!! $button !!}" url="{{ $buttonUrl }}" width="100" />
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td class="hero__button" align="center">
                                        {!! $button  !!}
                                    </td>
                                </tr>
                            @endif
                        @endisset
                    </table>
                </td>
            </tr>
            <x-mail::new-line />
        </table>
    </td>
</tr>
