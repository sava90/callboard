<?php
ini_set('display_errors', 0);
error_reporting(0);
require '../vendor/autoload.php';

function getResult($controllerName = '', $action = '')
{
    $controller = 'Controller\\'.$controllerName;

    if (is_array($controllerMethods = get_class_methods($controller))  && in_array($action, $controllerMethods)) {
        call_user_func(array(new $controller, $action));
    } else {
        header("Status: 404 Not Found");
        exit;
    }
}

getResult(@$_GET['controller'], @$_GET['action']);