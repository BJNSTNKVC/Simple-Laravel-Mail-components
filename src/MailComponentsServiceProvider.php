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
        $this->bootConfigs();
        $this->bootResources();
        $this->bootBladeComponents();
        $this->bootPublishing();
    }

    /**
     * Boot all config files.
     *
     * @return void
     */
    private function bootConfigs(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/config/mail_components.php', 'mail_components');
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
        $components   = config('mail_components.components') ?: [];
        $prefix       = config('mail_components.prefix');
        $separator    = config('mail_components.separator');

        foreach ($components as $alias => $class) {
            Blade::component($class, "{$prefix}{$separator}{$alias}");
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
        $this->publishes([
            __DIR__ . '/config/mail_components.php' => config_path('mail_components.php'),
        ], 'mail-config');

        $this->publishes([
            __DIR__ . '/resources/views/vendor/mail/html/themes/mail-components.css' => resource_path('/views/vendor/mail/html/themes/mail-components.css'),
        ], 'mail-styles');
    }
}
