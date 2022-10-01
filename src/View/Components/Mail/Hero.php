<?php

namespace Bjnstnkvc\MailComponents\View\Components\Mail;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Hero extends Component
{
    /**
     * @var string Hero section background Image.
     */
    public $background;

    /**
     * @var string Hero section height.
     */
    public $height;

    /**
     * @var string Hero section Title.
     */
    public $title;

    /**
     * @var string Hero section Subtitle.
     */
    public $subtitle;

    /**
     * @var string Hero section button.
     */
    public $button;

    /**
     * @var string Hero section button url.
     */
    public $buttonUrl;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($background = null, $height = null, $subtitle = null, $title = null, $button = null, $buttonUrl = null)
    {
        $this->background = $background ?: config('mail_components.hero.background');
        $this->height     = $height ?: config('mail_components.hero.height');
        $this->title      = $title;
        $this->subtitle   = $subtitle;
        $this->button     = $button;
        $this->buttonUrl  = $buttonUrl;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('mail-components::mail.hero');
    }
}
