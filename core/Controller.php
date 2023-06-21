<?php

namespace core;

use app\classes\Uri;
use app\controllers\ContainerController;
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
    public function load(): ContainerController
    {
        if ($this->isHome()) {
          return $this->controllerHome();
        }

        return $this->controllerNotHome();
    }

    private function controllerHome(): ContainerController
    {
        if (!$this->controllerExist('HomeController')) {
            throw new ControllerNotExistException("Esse controller não existe");
        }

        return $this->instantiateController();
    }

    private function controllerNotHome(): ContainerController
    {

        $controller = $this->getControllerNotHome();

        if (!$this->controllerExist($controller)) {
            throw new ControllerNotExistException("Esse controller não existe");
        }
       return $this->instantiateController();
    }

    private function getControllerNotHome(): string
    {
        if (substr_count($this->uri, '/') > 1) {
            $explode = explode('/', $this->uri);
            list($controller, $method) = array_values(array_filter($explode));
            $controller = ucfirst($controller) . 'Controller';
            return $controller;
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

    private function instantiateController(): ContainerController
    {
        $controller = $this->namespace . '\\' . $this->controller;
        return new $controller;
    }
}
