<?php

namespace core;

use Closure;
use Twig_Environment;
use Twig_Extensions_Extension_Text;
use Twig_Function;
use Twig_Loader_Filesystem;

class Twig
{
    private $twig;
    private $functions = [];
    public function loadTwig(): Twig_Environment
    {

        $this->twig = new Twig_Environment($this->loadViews(), [
            'debug' => true,
            'auto_reload' => true
        ]);

        return $this->twig;
    }

    private function loadViews(): Twig_Loader_Filesystem
    {
        return new Twig_Loader_Filesystem('../app/views');
    }

    public function loadExtensions(): void
    {
        $this->twig->addExtension(new Twig_Extensions_Extension_Text());
    }

    private function functionsToView($name, Closure $callback): Twig_Function
    {
        return new Twig_Function($name, $callback);
    }

    public function loadFunctions()
    {
        $this->functions[] = $this->functionsToView('user', function () {
            return 'dados user';
        });
        
        foreach ($this->functions as $key => $value) {
            $this->twig->addFunction($this->functions[$key]);
        }
    }
}
