<?php

namespace core;

use app\classes\Uri;
use app\controllers\ContainerController;
use app\controllers\ControllerInterface;
use app\exceptions\MethodNotExistException;

class Method
{
    private string $uri;

    public function __construct()
    {
        $this->uri = Uri::uri();
    }

    public function load(ContainerController $controller): string
    {
        $method = $this->getMethod();

        if (!method_exists($controller, $method)) {
            throw new MethodNotExistException("Método não existe: {$method}!");
        }

        return $method;
    }

    private function getMethod(): string
    {
        if (substr_count($this->uri, '/') > 1) {
            return array_values(array_filter(explode('/', $this->uri)))[1];
        }

        return 'index';
    }
}
