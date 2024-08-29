<?php

namespace Bjnstnkvc\MailComponents\Console\Commands;

use Bjnstnkvc\MailComponents\Helpers\Publisher;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PublishesComponents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'components:publish { component?* } { --force : Overwrites existing components. }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish components classes.';

    /**
     * Execute the console command.
     *
     * @return void
     *
     * @throws FileNotFoundException
     */
    public function handle(Filesystem $filesystem, Publisher $publisher)
    {
        $arguments = collect($this->argument('component'))->map(function (string $data) {
            return Str::slug(Str::snake($data));
        });

        // Get 'key - value' pairs of components that the User inputted, or return all if no arguments where passed.
        $components = $arguments->isNotEmpty()
            ? Arr::only(config('mail_components.components'), $arguments)
            : config('mail_components.components');

        foreach ($components as $view => $class) {
            $class               = Str::of($class)->explode('\\')->last();
            $class_file          = $filesystem->get($publisher->getClass($class));
            $config              = $filesystem->get($publisher->configPath);
            $updated_class_file  = $publisher->updateClass($view, $class_file);
            $updated_config_file = $publisher->updateConfig($class, $config);

            $filesystem->ensureDirectoryExists($publisher->publishedPath);
            $filesystem->ensureDirectoryExists($publisher->viewPath);

            if ($filesystem->exists($publisher->publishClass($class))) {
                if ($this->option('force')) {
                    $filesystem->put($publisher->publishClass($class), $updated_class_file);
                    $filesystem->copy($publisher->getView($view), $publisher->publishView($view));
                    $filesystem->put($publisher->configPath, $updated_config_file);
                } else {
                    $this->warn("File {$class}.php already exists!");

                    continue;
                }
            }

            $filesystem->put($publisher->publishClass($class), $updated_class_file);
            $filesystem->copy($publisher->getView($view), $publisher->publishView($view));
            $filesystem->put($publisher->configPath, $updated_config_file);

            $this->info("Successfully published {$class} component class!");
        }
    }
}
