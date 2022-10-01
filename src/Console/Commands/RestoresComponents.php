<?php

namespace Bjnstnkvc\MailComponents\Console\Commands;

use Bjnstnkvc\MailComponents\Helpers\Publisher;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class RestoresComponents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'components:restore {component?* } {--delete : Deletes Form component files. }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restores published components classes.';

    /**
     * Execute the console command.
     *
     * @return void
     *
     * @throws FileNotFoundException
     */
    public function handle(Filesystem $filesystem, Publisher $publisher)
    {
        // Get Components to restore.
        $arguments = array_map(function ($data) {
            return Str::slug(Str::snake($data));
        }, $this->argument('component'));

        // Get 'key - value' pairs of components that the User inputted, or return all if no arguments where passed.
        $components = $arguments
            ? Arr::only(config('form_components.components'), $arguments)
            : Arr::only(config('form_components.components'), $this->getPublishedComponents($publisher));

        foreach ($components as $view => $class) {
            // Get the class name from the Component config path.
            $class_name = Str::of($class)->explode('\\')->last();

            // Get the Components' config file.
            $config = $filesystem->get($publisher->configPath);

            // Get Component config file contents.
            $restored_config_file = $publisher->restoreClass($class_name, $config);

            // If option 'delete' has been passed, remove Component Class and View files.
            if ($this->option('delete')) {
                $filesystem->delete($publisher->publishClass($class_name));
                $filesystem->delete($publisher->publishView($view));
            }

            // Restore Component config file.
            $filesystem->put($publisher->configPath, $restored_config_file);

            // Display status message.
            $this->info('Successfully restored ' . $class_name . ' component class!');
        }
    }

    /**
     * Returns an array of all published components.
     *
     * @param Publisher $publisher
     *
     * @return array
     */
    private function getPublishedComponents(Publisher $publisher): array
    {
        $published_components = scandir($publisher->publishedPath);

        array_splice($published_components, 0, 2);

        return array_map(function ($data) {
            return Str::slug(Str::snake(Str::replaceFirst('.php', '', $data)));
        }, $published_components);
    }
}
