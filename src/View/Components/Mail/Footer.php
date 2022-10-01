<?php

namespace Bjnstnkvc\MailComponents\View\Components\Mail;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Footer extends Component
{
    /**
     * @var string Footer Email address.
     */
    public $email;

    /**
     * @var string|null Footer country.
     */
    public $country;

    /**
     * @var string|null Footer state.
     */
    public $state;

    /**
     * @var string|null Footer city.
     */
    public $city;

    /**
     * @var string|null Footer street address.
     */
    public $address;

    /**
     * @var string|null Footer zip code.
     */
    public $zip;

    /**
     * @var string|null Footer phone number.
     */
    public $phone;

    /**
     * @var bool Determine whether to display Footer copyright.
     */
    public $showCopyright;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($email = null, $country = null, $state = null, $city = null, $address = null, $zip = null, $phone = null, $showCopyright = null)
    {
        $this->email         = $email ?: config('mail.from.address');
        $this->country       = $country ?: config('mail_components.footer.country');
        $this->state         = $state ?: config('mail_components.footer.state');
        $this->city          = $city ?: config('mail_components.footer.city');
        $this->address       = $address ?: config('mail_components.footer.address');
        $this->zip           = $zip ?: config('mail_components.footer.zip');
        $this->phone         = $phone ?: config('mail_components.footer.phone');
        $this->showCopyright = filter_var($showCopyright ?: config('mail_components.footer.show_copyright'), FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('mail-components::mail.footer');
    }
}
