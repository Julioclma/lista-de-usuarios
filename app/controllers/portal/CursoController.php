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

        $data = (array)$request;
        $this->view($data, 'portal.curso');

    }
}
