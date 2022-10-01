<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{--<!-- Email Title -->--}}
    <title>{{ $title }}</title>

    {{--<!-- Email Fonts -->--}}
    @if(Str::contains($font, '<link'))
        {{ $font }}
    @else
        <link href="{{ $font }}" rel="stylesheet">
    @endif

    {{--<!-- Email Styles -->--}}
    <link href="{{ asset('css/mail-components.css') }}" rel="stylesheet">

    {{--<!-- Responsiveness  -->--}}
    <style type="text/css">
        * {
            font-family : {{ $fontFamily }}, sans-serif;
        }

        @media all and (min-width : 414px) {
            .grid-col-4 .mobile {
                display : inline-block !important;
                width   : 50% !important;
                padding : 8px !important;
            }
        }

        @media all and (min-width : 576px) {
            .content {
                padding : 8px 16px !important;
            }

            :is(.header, .footer) .content {
                padding : 0 !important;
            }

            .subcopy__content {
                padding : 8px 16px !important;
            }

            .mobile {
                display : table-cell !important;
                padding : 0 8px !important;
            }

            .mobile + .mobile {
                display : table-cell !important;
            }

            .grid .mobile + .mobile {
                padding-top : 0 !important;
            }

            .grid-col-1 .mobile {
                max-width : 100% !important;
                width     : auto !important;
            }

            .grid-col-2 .mobile {
                max-width : 50% !important;
                width     : auto !important;
            }

            .grid-col-3 .mobile {
                max-width : 33% !important;
                width     : auto !important;
            }

            .grid-col-4 .mobile {
                max-width      : 25% !important;
                width          : auto !important;
                padding-top    : 0 !important;
                padding-bottom : 0 !important;
                display        : table-cell !important;
            }

            .img {
                width : auto !important;
            }
        }
    </style>
</head>
<body bgcolor="{{ $background }}">
<table {{ $attributes->merge(['class' => 'wrapper']) }} width="100%" border="0" cellpadding="0" cellspacing="0">
    {{ $slot }}
</table>
</body>
</html>
