<?php

namespace Bjnstnkvc\MailComponents\View\Components\Mail;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Grid extends Component
{
    /**
     * @var string Grid Background color.
     */
    public $background;

    /**
     * @var int Number of Grid Columns.
     */
    public $columns;

    /**
     * @var string Grid spacing.
     */
    public $spacing;

    /**
     * @var string|null Grid Column first Slot.
     */
    public $one;

    /**
     * @var string|null Grid Column second Slot.
     */
    public $two;

    /**
     * @var string|null Grid Column third Slot.
     */
    public $three;

    /**
     * @var string|null Grid Column fourth Slot.
     */
    public $four;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($background = null, $columns = 1, $spacing = null, $one = null, $two = null, $three = null, $four = null)
    {
        $this->background = $background ?: config('mail_components.grid.background');
        $this->columns    = $columns;
        $this->spacing    = $spacing ?: config('mail_components.grid.spacing');
        $this->one        = $one;
        $this->two        = $two;
        $this->three      = $three;
        $this->four       = $four;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('mail-components::mail.grid');
    }
}
