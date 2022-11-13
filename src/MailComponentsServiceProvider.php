<?php

namespace Bjnstnkvc\MailComponents;

use Bjnstnkvc\MailComponents\Console\Commands\PublishesComponents;
use Bjnstnkvc\MailComponents\Console\Commands\RestoresComponents;
use Bjnstnkvc\MailComponents\View\Components\Mail\Button;
use Bjnstnkvc\MailComponents\View\Components\Mail\Content;
use Bjnstnkvc\MailComponents\View\Components\Mail\NewLine;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class MailComponentsServiceProvider extends ServiceProvider
{
    /**
     * @var array Mail components.
     */
    public $components;

    /**
     * @var string Mail components prefix.
     */
    public $prefix;

    /**
     * @var string Mail components separator.
     */
    public $separator;

    /**
     * @var string Mail components theme publish public path.
     */
    public $publicPath;

    /**
     * @var string Mail components theme publish resource path.
     */
    public $resourcePath;

    /**
     * Create new Service Provider instance.
     *
     * @param $app
     */
    public function __construct($app)
    {
        parent::__construct($app);

        $this->components   = config('mail_components.components') ?: [];
        $this->prefix       = config('mail_components.prefix');
        $this->separator    = config('mail_components.separator');
        $this->publicPath   = public_path('/css');
        $this->resourcePath = resource_path('/views/vendor/mail/html/themes');
    }


    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                PublishesComponents::class,
                RestoresComponents::class,
            ]);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->bootResources();
        $this->bootBladeComponents();
        $this->bootPublishing();
    }

    /**
     * Boot all blade files from resources.
     *
     * @return void
     */
    private function bootResources(): void
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views/components', 'mail-components');
    }

    /**
     * Boot all Blade components.
     *
     * @return void
     */
    private function bootBladeComponents(): void
    {
        foreach ($this->components as $alias => $class) {
            Blade::component($class, $this->prefix . $this->separator . $alias);
        }

        Blade::component(Button::class, 'mail::button');
        Blade::component(Content::class, 'mail::content');
        Blade::component(NewLine::class, 'mail::new-line');
    }

    /**
     * Boot all publishable files.
     *
     * @return void
     */
    private function bootPublishing(): void
    {
        // Publish Mail Component Config file.
        $this->publishes([
            __DIR__ . '/config/mail_components.php' => config_path('mail_components.php'),
        ], 'mail-config');

        // Publish Mail Component Styles.
        $this->publishes([
            __DIR__ . '/resources/views/vendor/mail/html/themes/mail-components.css' => $this->resourcePath . '/mail-components.css',
        ], 'mail-styles');
    }
}
