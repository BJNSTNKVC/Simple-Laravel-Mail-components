<?php

namespace Bjnstnkvc\MailComponents\View\Components\Mail;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * @var string Header logo.
     */
    public $logo;

    /**
     * @var string Header logo width.
     */
    public $width;

    /**
     * @var string Header logo height.
     */
    public $height;

    /**
     * @var bool Determine whether to show Header Logo.
     */
    public $showLogo;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($logo = null, $width = null, $height = null, $showLogo = null)
    {
        $this->logo     = $logo ?: config('mail_components.header.logo');
        $this->width    = $width ?: config('mail_components.header.width');
        $this->height   = $height ?: config('mail_components.header.height');
        $this->showLogo = filter_var($showLogo ?: config('mail_components.header.show'), FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('mail-components::mail.header');
    }
}
