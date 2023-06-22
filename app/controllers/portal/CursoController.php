<?php

namespace app\controllers\portal;

use app\controllers\ContainerController;
use app\controllers\ControllerInterface;
use core\Parameters;

class CursoController extends ContainerController
{
    public function index(): void
    {
    }

    public function show(object $request): void
    {

        $this->view([
            'title' => 'Curso',
            'user' => 'dados do user',
            'curso' => 'LOREM IPSUM DOLOR SIT AMET, CONSECTTETUR ADIPISICING ELIT. LOREM IPSUM DOLOR SIT AMET, CONSECTTETUR ADIPISICING ELIT. LOREM IPSUM DOLOR SIT AMET, CONSECTTETUR ADIPISICING ELIT. LOREM IPSUM DOLOR SIT AMET, CONSECTTETUR ADIPISICING ELIT'
        ], 'portal.curso');
    }
}
