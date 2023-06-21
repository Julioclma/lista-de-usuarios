<?php

namespace core;

use app\classes\Uri;
use app\controllers\ControllerInterface;
use app\exceptions\MethodNotExistException;

class Method
{
    private string $uri;

    public function __construct()
    {
        $this->uri = Uri::uri();
    }

    public function load(ControllerInterface $controller): void
    {
        $method = $this->getMethod();
        
        if (!method_exists($controller, $method)) {
            throw new MethodNotExistException("Método não existe: {$method}!");
        }

        $controller->$method();
    }

    private function getMethod(): string
    {
        if (substr_count($this->uri, '/') > 1) {
            return array_filter(explode('/', $this->uri))[2];
        }

        return 'index';
    }
}
