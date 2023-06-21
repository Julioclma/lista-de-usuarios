<?php

namespace app\controllers;

use app\traits\View;

abstract class ContainerController
{
    use View;

    public abstract function index() : void;


}
