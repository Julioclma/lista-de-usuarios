<?php

namespace app\controllers\portal;
use app\controllers\ControllerInterface;

class HomeController implements ControllerInterface
{
    public function index() : void
    {
        dd(get_class());
    }
    
}