<tr>
    <td align="center" valign="top">
        <table class="content table-content" width="100%" cellpadding="0" cellspacing="0" border="0">
            <x-mail::new-line />
            <tr>
                <td class="content__body" align="center" valign="top">
                    <table class="table table__small" background="{{ $background }}" bgcolor="{{ $background }}" style="background-image: url({{ $background }}); background-color: {{ $background }}">
                        <thead background="{{ $headerBackground }}" bgcolor="{{ $headerBackground }}" style="background-image: url({{ $headerBackground }}); background-color: {{ $headerBackground }}">
                            <tr>
                                @if($rowIndex)
                                    <th>#</th>
                                @endif
                                @foreach($headers as $header)
                                    <th>{{ Str::ucfirst(str_replace(['_'], [' '], $header)) }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($columns as $column)
                                <tr>
                                    @if($rowIndex)
                                        <td>{{ $loop->iteration }}</td>
                                    @endif
                                    @foreach($headers as $header)
                                        <td>{{ $model ? $column[$header] : (is_string($column) ? $column : $column[$loop->index]) }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            <x-mail::new-line />
        </table>
    </td>
</tr>
