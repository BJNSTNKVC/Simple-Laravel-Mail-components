<?php

namespace Bjnstnkvc\MailComponents\View\Components\Mail;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Content extends Component
{
    /**
     * @var string Content Background color.
     */
    public $background;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($background = null)
    {
        $this->background = $background ?: config('mail_components.content.background');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('mail-components::mail.content');
    }
}
