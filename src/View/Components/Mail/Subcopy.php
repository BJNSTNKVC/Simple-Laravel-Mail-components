<?php

namespace Bjnstnkvc\MailComponents\View\Components\Mail;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Subcopy extends Component
{
    /**
     * @var string Subcopy Background color.
     */
    public $background;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($background = null)
    {
        $this->background = $background ?: config('mail_components.subcopy.background');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('mail-components::mail.subcopy');
    }
}
