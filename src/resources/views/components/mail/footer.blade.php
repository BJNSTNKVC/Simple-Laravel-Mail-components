@if($show)
    <tr>
        <td align="center" valign="top">
            <table class="footer" width="100%" cellpadding="0" cellspacing="0" border="0">
                <x-mail::new-line/>

                @if($slot != '')
                    <x-mail::content>
                        {{ $slot }}
                    </x-mail::content>

                    <x-mail::new-line/>
                @endif

                @if($email)
                    <x-mail::content>
                        <a href="mailto:{{ $email }}">{{ $email }}</a>
                    </x-mail::content>
                @endif

                @if($address || $city || $zip || $state || $phone)
                    <x-mail::content>

                        <a href="{{ 'https://www.google.com/maps/place/' . urlencode(($address ? $address . ', ' : '') . ' ' . ($city ? $city . ', ' : '') . $zip) }}">{{ ($address ?: '') . ($address && ($city || $state || $zip) ? ', ' : '') . ($city ?: '') . ($city && ($state || $zip) ? ', ' : '') . ($state ?: '') . ($state && $zip ? ' ' : '') . $zip }}</a>

                        @if($phone)
                            @if($address || $city || $zip || $state)
                                •
                            @endif
                            <a href="tel:{{ preg_replace('/[^[:digit:]]/', '', $phone) }}}">{{ $phone }}</a>
                        @endif

                    </x-mail::content>
                @endif

                @if($showCopyright)
                    <x-mail::new-line/>

                    <x-mail::content>
                        Copyright © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                    </x-mail::content>
                @endif

                <x-mail::new-line/>
            </table>
        </td>
    </tr>
@endif
