<?php

namespace Bjnstnkvc\MailComponents\View\Components\Mail;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{
    /**
     * @var string Layout Background color.
     */
    public $background;

    /**
     * @var string Layout Header title.
     */
    public $title;

    /**
     * @var string Layout Header font.
     */
    public $font;

    /**
     * @var string Layout Header font family.
     */
    public $fontFamily;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($background = null, $title = null, $font = null, $fontFamily = null, $isMarkdown = null)
    {
        $this->background = $background ?: config('mail_components.layout.background');
        $this->title      = $title ?: config('app.name');
        $this->font       = $font ?: config('mail_components.layout.font_link');
        $this->fontFamily = $fontFamily ?: config('mail_components.layout.font_family');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('mail-components::mail.layout');
    }
}
