<?php

namespace Bjnstnkvc\MailComponents\View\Components\Mail;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    /**
     * @var string Button link.
     */
    public $url;

    /**
     * @var string Button title.
     */
    public $title;

    /**
     * @var string Button width.
     */
    public $width;

    /**
     * @var string Button height.
     */
    public $height;

    /**
     * @var string Button color.
     */
    public $color;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($url, $title = null, $width = null, $height = null, $color = null)
    {
        $this->url    = $url;
        $this->title  = $title;
        $this->width  = $width ?: config('mail_components.button.width');
        $this->height = $height ?: config('mail_components.button.height');
        $this->color  = $color ?: config('mail_components.button.color');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('mail-components::mail.button');
    }
}
