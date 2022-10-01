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
        // Get Components to publish.
        $arguments = array_map(function ($data) {
            return Str::slug(Str::snake($data));
        }, $this->argument('component'));

        // Get 'key - value' pairs of components that the User inputted, or return all if no arguments where passed.
        $components = $arguments
            ? Arr::only(config('mail_components.components'), $arguments)
            : config('mail_components.components');

        foreach ($components as $view => $class) {
            // Get the class name from the Component config path.
            $class = Str::of($class)->explode('\\')->last();

            // Get the Component class file.
            $class_file = $filesystem->get($publisher->getClass($class));

            // Get the Components' config file.
            $config = $filesystem->get($publisher->configPath);

            // Update Component Class file.
            $updated_class_file = $publisher->updateClass($view, $class_file);

            // Update Component config file.
            $updated_config_file = $publisher->updateConfig($class, $config);

            // In case Class and resource folders do not exist, create them.
            $filesystem->ensureDirectoryExists($publisher->publishedPath);
            $filesystem->ensureDirectoryExists($publisher->viewPath);

            // Check if the Component already exists.
            if ($filesystem->exists($publisher->publishClass($class))) {
                //  In case 'force' option is passed, overwrite the existing files, otherwise, show the warning message.
                if ($this->option('force')) {
                    $filesystem->put($publisher->publishClass($class), $updated_class_file);
                    $filesystem->copy($publisher->getView($view), $publisher->publishView($view));
                    $filesystem->put($publisher->configPath, $updated_config_file);
                } else {
                    $this->warn('File ' . $class . '.php already exists!');

                    continue;
                }
            }

            // Publish Form Component, View and config file.
            $filesystem->put($publisher->publishClass($class), $updated_class_file);
            $filesystem->copy($publisher->getView($view), $publisher->publishView($view));
            $filesystem->put($publisher->configPath, $updated_config_file);

            // Display status message.
            $this->info('Successfully published ' . $class . ' component class!');
        }
    }
}
