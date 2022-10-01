<tr>
    <td align="center" valign="top">
        <table class="header" width="100%" cellpadding="0" cellspacing="0" border="0">

            @if($showLogo && $logo != '')
                <x-mail::new-line />

                <x-mail::content>
                    <a href="{{ config('app.url') }}">
                        <img class="logo" src="{{ $logo }}" alt="{{ config('app.name') }} logo" width="{{ $width }}" height="{{ $height }}" />
                    </a>
                </x-mail::content>

                <x-mail::new-line />
            @endif

            @if($slot != '')
                @unless($showLogo)
                    <x-mail::new-line />
                @endunless

                <x-mail::content>
                    {{ $slot }}
                </x-mail::content>

                <x-mail::new-line />
            @endif

        </table>
    </td>
</tr>
