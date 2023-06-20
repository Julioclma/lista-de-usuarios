<?php

namespace core;

use app\classes\Uri;

class Controller
{
    private string $uri;
    private array $folders = [
        'app\controllers\portal',
        'app\controllers\admin'
    ];
    private string $controller;
    private string $namespace;

    public function __construct()
    {
        $this->uri = Uri::uri();
    }
    public function load(): void
    {
        if ($this->isHome()) {
            $controller = $this->controllerHome();
            new $controller;
        }

        return $this->controllerNotHome();
    }

    private function controllerHome() : string
    {
        if (!$this->controllerExist('HomeController')) {
            throw new ControllerNotExistException("Esse controller não existe");
        }

        return $this->instantiateController();
    }

    private function controllerNotHome()
    {
    }
    private function isHome(): bool
    {
        return ($this->uri === '/');
    }

    private function controllerExist(string $controller): bool
    {
        $controllerExist = false;

        foreach ($this->folders as $folder) {
            if (class_exists($folder . '\\' . $controller)) {
                $controllerExist = true;
                $this->namespace = $folder;
                $this->controller = $controller;
            }
        }
        return $controllerExist;
    }

    private function instantiateController() : string
    {
        $controller = $this->namespace . '\\' . $this->controller;
        return $controller;
    }
}
