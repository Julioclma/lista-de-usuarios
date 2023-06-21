<?php

namespace app\controllers\portal;

use app\controllers\ContainerController;
use app\controllers\ControllerInterface;

class ProdutoController extends ContainerController
{
    public function index(): void
    {
        dd(get_class());
    }
    
}