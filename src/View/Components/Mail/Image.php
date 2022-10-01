<?php

namespace Bjnstnkvc\MailComponents\View\Components\Mail;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Image extends Component
{
    /**
     * @var string Image source.
     */
    public $src;

    /**
     * @var string Image Alternative text description.
     */
    public $alt;

    /**
     * @var string Image width.
     */
    public $width;

    /**
     * @var string Image height.
     */
    public $height;

    /**
     * @var bool Determine whether the Image is Responsive.
     */
    public $isResponsive;

    /**
     * @var bool Determine whether to display Image as a section.
     */
    public $asSection;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($src, $alt = null, $width = 'auto', $height = 'auto', $isResponsive = null, $asSection = null)
    {
        $this->src          = $src;
        $this->alt          = $alt;
        $this->width        = $width;
        $this->height       = $height;
        $this->isResponsive = filter_var($isResponsive ?: config('mail_components.image.is_responsive'), FILTER_VALIDATE_BOOLEAN);
        $this->asSection    = filter_var($asSection ?: config('mail_components.image.as_section'), FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('mail-components::mail.image');
    }
}
