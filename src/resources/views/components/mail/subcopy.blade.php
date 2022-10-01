<tr>
    <td align="center" valign="top">
        <table {{ $attributes->merge(['class' => 'subcopy']) }} width="100%" cellpadding="0" cellspacing="0" border="0" background="{{ $background }}" bgcolor="{{ $background }}" style="background-image: url({{ $background }}); background-color: {{ $background }}">
            <x-mail::new-line/>
            <tr>
                <td class="subcopy__content" align="center" valign="top">
                    {{ $slot }}
                </td>
            </tr>
            <x-mail::new-line/>
        </table>
    </td>
</tr>

