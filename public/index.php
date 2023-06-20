<?php

include __DIR__ . '/../bootstrap.php';

use app\classes\Uri;
use core\Controller;

try {
    $controller = new Controller;
    $controller->load();
} catch (Exception $e) {
    dd($e->getMessage());
}
