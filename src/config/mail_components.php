<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Mail Components
    |--------------------------------------------------------------------------
    |
    | Here you may specify which components you would like to use as well
    | as their default behaviours.
    |
    */

    // List of all Components that are going to be loaded. Feel free to comment out the components you don't need.
    'components' => [
        'button'   => Bjnstnkvc\MailComponents\View\Components\Mail\Button::class,
        'content'  => Bjnstnkvc\MailComponents\View\Components\Mail\Content::class,
        'footer'   => Bjnstnkvc\MailComponents\View\Components\Mail\Footer::class,
        'grid'     => Bjnstnkvc\MailComponents\View\Components\Mail\Grid::class,
        'header'   => Bjnstnkvc\MailComponents\View\Components\Mail\Header::class,
        'hero'     => Bjnstnkvc\MailComponents\View\Components\Mail\Hero::class,
        'image'    => Bjnstnkvc\MailComponents\View\Components\Mail\Image::class,
        'layout'   => Bjnstnkvc\MailComponents\View\Components\Mail\Layout::class,
        'new-line' => Bjnstnkvc\MailComponents\View\Components\Mail\NewLine::class,
        'subcopy'  => Bjnstnkvc\MailComponents\View\Components\Mail\Subcopy::class,
        'table'    => Bjnstnkvc\MailComponents\View\Components\Mail\Table::class,
    ],

    // Mail Components prefix (E.g. <x-mail-button>).
    'prefix'     => 'mail',

    // Mail Components separator (E.g. <x-mail::button>).
    'separator'  => '::',

    // Mail font link and font family.
    'layout'     => [
        'font_link'   => 'https://fonts.googleapis.com/css2?family=Roboto&display=swap',
        'font_family' => 'Roboto',
        'background'  => '#F2F2F2',
    ],

    // Mail background color.

    // Mail Header component settings.
    'header'     => [
		'show'    => true,
        'app_url' => config('app.url'),
        'logo'    => 'https://via.placeholder.com/100x100',
        'width'   => 75,
        'height'  => 75,
    ],

    // Mail Footer component info.
    'footer'     => [
        'show'           => true,
        'show_copyright' => true,
        'address'        => null,
        'city'           => null,
        'state'          => null,
        'zip'            => null,
        'phone'          => null,
    ],

    // Mail Content component settings.
    'content'    => [
        'background' => 'transparent',
    ],

    // Mail Grid component settings.
    'grid'       => [
        'background' => 'transparent',
        'spacing'    => 'top, bottom',
    ],

    // Mail Hero component settings.
    'hero'       => [
        'background' => 'transparent',
        'height'     => 400,
    ],

    // Mail Subcopy component settings.
    'subcopy'    => [
        'background' => 'transparent',
    ],

    // Mail Table component settings.
    'table'      => [
        'row_index'         => false,
        'background'        => 'rgba(255, 255, 255, 1)',
        'header_background' => 'rgba(115, 111, 110, 0.15)',
    ],

    // Mail Image component settings.
    'image'      => [
        'is_responsive' => false,
        'as_section'    => true,
    ],

    // Mail Button component settings.
    'button'     => [
        'width'  => 200,
        'height' => 40,
        'color'  => 'black',
    ],

    // Mail New Line component settings.
    'new_line' => [
        'height'     => 16,
        'background' => 'transparent',
    ],
];
