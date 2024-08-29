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
     * @var bool Determine whether to display the Footer.
     */
    public $show;

    /**
     * @var bool Determine whether to display the Footer copyright.
     */
    public $showCopyright;

    /**
     * @var string Full address of the Footer.
     */
    public $fullAddress;

    /**
     * @var string Google Map URL for the Footer.
     */
    public $mapUrl;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($email = null, $country = null, $state = null, $city = null, $address = null, $zip = null, $phone = null, $show = null, $showCopyright = null)
    {
        $this->email         = $email ?: config('mail_components.footer.email');
        $this->country       = $country ?: config('mail_components.footer.country');
        $this->state         = $state ?: config('mail_components.footer.state');
        $this->city          = $city ?: config('mail_components.footer.city');
        $this->address       = $address ?: config('mail_components.footer.address');
        $this->zip           = $zip ?: config('mail_components.footer.zip');
        $this->phone         = $phone ?: config('mail_components.footer.phone');
        $this->show          = filter_var($show ?: config('mail_components.footer.show'), FILTER_VALIDATE_BOOLEAN);
        $this->showCopyright = filter_var($showCopyright ?: config('mail_components.footer.show_copyright'), FILTER_VALIDATE_BOOLEAN);
        $this->fullAddress   = $this->getFullAddress($this->address, $this->city, $this->zip, $this->state);
        $this->mapUrl        = $this->getMapUrl($this->address, $this->city, $this->zip);
    }

    /**
     * Get the full address.
     *
     * @param string|null $address
     * @param string|null $city
     * @param string|null $zip
     * @param string|null $state
     *
     * @return string
     */
    private function getFullAddress(?string $address = null, ?string $city = null, ?string $zip = null, ?string $state = null): string
    {
        return collect(func_get_args())->filter()->implode(', ');
    }

    /**
     * Get the Google Map URL.
     *
     * @param string|null $address
     * @param string|null $city
     * @param string|null $zip
     *
     * @return string
     */
    private function getMapUrl(?string $address = null, ?string $city = null, ?string $zip = null): string
    {
        return 'https://www.google.com/maps/place/' . collect(func_get_args())->filter()->implode(', ');
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
