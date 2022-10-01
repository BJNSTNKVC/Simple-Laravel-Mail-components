<tr>
    <td align="center" valign="top">
        <table {{ $attributes->merge(['class' => 'content']) }} width="100%" cellpadding="0" cellspacing="0" border="0" background="{{ $background }}" bgcolor="{{ $background }}" style="background-image: url({{ $background }}); background-color: {{ $background }}">
            <tr>
                <td class="content__body" align="center" valign="top">
                    {{ $slot }}
                </td>
            </tr>
        </table>
    </td>
</tr>
