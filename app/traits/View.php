<?php

namespace app\traits;

use core\Twig;

trait View
{
    private function twig()
    {
        $twig = new Twig;
        
        return $twig->loadTwig();
    }

    public function view(array $data, string $view)
    {
        $path = str_replace('.', '/', $view) . '.html';
        $template = $this->twig()->load($path);

        return $template->display($data);
    }
}
