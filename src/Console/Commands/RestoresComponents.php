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
        $arguments = collect($this->argument('component'))->map(function (string $data) {
            return Str::slug(Str::snake($data));
        });

        $components = $arguments->isNotEmpty()
            ? Arr::only(config('mail_components.components'), $arguments)
            : Arr::only(config('mail_components.components'), $this->getPublishedComponents($publisher));

        foreach ($components as $view => $class) {
            $class_name           = Str::of($class)->explode('\\')->last();
            $config               = $filesystem->get($publisher->configPath);
            $restored_config_file = $publisher->restoreClass($class_name, $config);

            if ($this->option('delete')) {
                $filesystem->delete($publisher->publishClass($class_name));
                $filesystem->delete($publisher->publishView($view));
            }

            $filesystem->put($publisher->configPath, $restored_config_file);

            $this->info("Successfully restored {$class_name} component class!");
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

        return collect($published_components)
            ->splice(2)
            ->map(function (string $data) {
                return Str::slug(Str::snake(Str::replaceFirst('.php', '', $data)));
            })
            ->toArray();
    }
}
