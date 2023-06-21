<?php

namespace core;
use Twig_Environment;
use Twig_Loader_Filesystem;

class Twig
{
    private $twig;
    private $functions = [];
    public function loadTwig()
    {
        
        $this->twig = new Twig_Environment($this->loadViews(), [
            'debug' => true,
            'auto_reload' =>true
        ]);

        return $this->twig;
    }

    private function loadViews()
    {
        return new Twig_Loader_Filesystem('../app/views');
    }

}
