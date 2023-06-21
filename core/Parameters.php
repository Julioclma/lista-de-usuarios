<?php

namespace core;

use app\classes\Uri;

class Parameters
{
    private string $uri;
    public function __construct()
    {
        $this->uri = Uri::uri();
    }

    public function load(): object
    {
        return $this->getParameter();
    }

    private function getNextParameter($actual): string
    {
        $parameter = array_values(array_filter(explode('/', $this->uri)));

        return $parameter[$actual + 1] ??  $parameter[$actual];
    }
    private function getParameter(): object
    {
        if (substr_count($this->uri, '/') > 2) {
            $parameter = array_values(array_filter(explode('/', $this->uri)));
            return (object)[
                'parameter' => filter_var($parameter[2], FILTER_SANITIZE_STRING),
                'next' => filter_var($this->getNextParameter(2), FILTER_SANITIZE_STRING)
            ];
        }
    }
}
