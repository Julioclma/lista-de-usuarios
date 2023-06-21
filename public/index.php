<?php

include __DIR__ . '/../bootstrap.php';

use app\classes\Uri;
use core\Controller;
use core\Method;
use core\Parameters;

try {
    $controller = new Controller;
    $controller = $controller->load();


    $method = new Method;
    $method = $method->load($controller);

    $parameters = new Parameters();
    $parameters = $parameters->load();

    $controller->$method($parameters);

    // $controller->$method();
} catch (Exception $e) {
    dd($e->getMessage());
}
