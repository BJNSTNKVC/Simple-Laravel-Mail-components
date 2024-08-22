<tr>
    <td align="center" valign="top">
        <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="{{ $background }}">
            @if(Str::contains($spacing, 'top'))
                <x-mail::new-line />
            @endif
            <tr>
                <td align="center" valign="top">
                    <table {{ $attributes->merge(['class' => "container grid grid-col-$columns"]) }} width="600" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td class="mobile" align="center" valign="top" {{ $one?->attributes }}>
                                {{ $one ?: $slot }}
                            </td>
                            @if ($columns >= 2)
                                <td class="mobile" align="center" valign="top" {{ $two->attributes }}>
                                    {{ $two }}
                                </td>
                            @endif
                            @if ($columns >= 3)
                                <td class="mobile" align="center" valign="top" {{ $three->attributes }}>
                                    {{ $three }}
                                </td>
                            @endif
                            @if ($columns >= 4)
                                <td class="mobile" align="center" valign="top" {{ $four->attributes }}>
                                    {{ $four }}
                                </td>
                            @endisset
                        </tr>
                    </table>
                </td>
            </tr>
            @if(Str::contains($spacing, 'bottom'))
                <x-mail::new-line />
            @endif
        </table>
    </td>
</tr>
