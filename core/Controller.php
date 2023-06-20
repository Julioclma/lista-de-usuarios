<?php

namespace core;

use app\classes\Uri;
use app\controllers\ControllerInterface;
use app\exceptions\ControllerNotExistException;

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
            $this->controllerHome()->index();
        }

        $this->controllerNotHome();
    }

    private function controllerHome(): ControllerInterface
    {
        if (!$this->controllerExist('HomeController')) {
            throw new ControllerNotExistException("Esse controller não existe");
        }

        return $this->instantiateController();
    }

    private function controllerNotHome()
    {

        $controller = $this->getControllerNotHome();

        if (!$this->controllerExist($controller)) {
            dd($controller);
            throw new ControllerNotExistException("Esse controller não existe");
        }
        $this->instantiateController()->index();
    }

    private function getControllerNotHome(): string
    {
        if (substr_count($this->uri, '/') > 1) {
            list($controller) = explode('/', $this->uri);
            dd($controller);
            return ucfirst($controller) . 'Controller';
        }   

        return ucfirst(ltrim($this->uri, '/')) . 'Controller';
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

    private function instantiateController(): ControllerInterface
    {
        $controller = $this->namespace . '\\' . $this->controller;
        return new $controller;
    }
}
