<?php

namespace Bjnstnkvc\MailComponents\Helpers;

class Publisher
{
    /**
     * Components Class root directory.
     *
     * @var string
     */
    public $classRoot;

    /**
     * Components View root directory.
     *
     * @var string
     */
    public $viewsRoot;

    /**
     * Components published config path.
     *
     * @var string
     */
    public $configPath;

    /**
     * Components published view path.
     *
     * @var string
     */
    public $viewPath;

    /**
     * Components default Namespace.
     *
     * @var string
     */
    public $defaultNamespace;

    /**
     * Components published Namespace.
     *
     * @var string
     */
    private $publishedNamespace;

    /**
     * Components default class path.
     *
     * @var string
     */
    private $defaultPath;

    /**
     * Components published class path.
     *
     * @var string
     */
    public $publishedPath;

    /**
     * Components default view/blade name.
     *
     * @var string
     */
    private $defaultBlade;

    /**
     * Components published view/blade name.
     *
     * @var string
     */
    private $publishedBlade;

    public function __construct()
    {
        $this->classRoot          = __DIR__ . '\..\View\Components\Mail\\';
        $this->viewsRoot          = __DIR__ . '\..\resources\views\components\mail\\';
        $this->configPath         = file_exists(config_path('mail_components.php')) ? config_path('mail_components.php') : __DIR__ . '\..\config\mail_components.php';
        $this->viewPath           = resource_path('views\components\mail\\');
        $this->defaultNamespace   = 'Bjnstnkvc\MailComponents\View\Components\Mail';
        $this->publishedNamespace = 'App\View\Components\Form';
        $this->defaultPath        = 'Bjnstnkvc\MailComponents\View\Components\Mail\\';
        $this->publishedPath      = 'App\View\Components\Form\\';
        $this->defaultBlade       = 'mail-components::mail.';
        $this->publishedBlade     = 'components.mail.';
    }

    /**
     * Returns Class location.
     *
     * @param string $class Class name.
     *
     * @return string
     */
    public function getClass(string $class): string
    {
        return "{$this->classRoot}{$class}.php";
    }

    /**
     * Returns View location.
     *
     * @param string $view View name.
     *
     * @return string
     */
    public function getView(string $view): string
    {
        return "{$this->viewsRoot}{$view}.blade.php";
    }

    /**
     * Returns published Class location.
     *
     * @param string $class Class name.
     *
     * @return string
     */
    public function publishClass(string $class): string
    {
        return "{$this->publishedPath}{$class}.php";
    }

    /**
     * Returns published View location.
     *
     * @param string $view Class name.
     *
     * @return string
     */
    public function publishView(string $view): string
    {
        return "{$this->viewPath}{$view}.blade.php";
    }

    /**
     * Updates Component Class file content.
     *
     * @param string $view  Name of the view.
     * @param string $class Class file.
     *
     * @return array|string|string[]
     */
    public function updateClass(string $view, string $class)
    {
        return str_replace(
            [$this->defaultNamespace, $this->defaultBlade . $view],
            [$this->publishedNamespace, $this->publishedBlade . $view],
            $class
        );
    }

    /**
     * Updates Components' config file contents.
     *
     * @param string $class  Name of the class.
     * @param string $config Class config.
     *
     * @return array|string|string[]
     */
    public function updateConfig(string $class, string $config)
    {
        return str_replace(
            "{$this->defaultPath}{$class}::class",
            "{$this->publishedPath}{$class}::class",
            $config
        );
    }

    /**
     * Restores published Component Classes.
     *
     * @param string $view  Name of the view.
     * @param string $class Class file.
     *
     * @return array|string|string[]
     */
    public function restoreClass(string $view, string $class)
    {
        return str_replace(
            [$this->publishedNamespace, $this->publishedBlade . $view],
            [$this->defaultNamespace, $this->defaultBlade . $view],
            $class
        );
    }
}
