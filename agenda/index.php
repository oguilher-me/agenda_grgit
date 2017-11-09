<?php

/**
 * Overwriteof default __autoload
 */
spl_autoload_register('apiAutoload');

function apiAutoload($classname)
{
    try {

        $class = null;

        if (preg_match('/[a-zA-Z]+Controller$/', $classname)) {
            $class = __DIR__ . '/controllers/' . $classname . '.php';
        } elseif (preg_match('/[a-zA-Z]+Model$/', $classname)) {
            $class = __DIR__ . '/model/' . $classname . '.php';
        } elseif (preg_match('/[a-zA-Z]+View$/', $classname)) {
            $class = __DIR__ . '/view/' . $classname . '.php';
        } else {
            $class = __DIR__ . '/config/' . str_replace('_', DIRECTORY_SEPARATOR, $classname) . '.php';
        }

        if (file_exists($class)) {
            require_once($class);
            return true;
        } else {
            throw new Exception();
        }

    } catch (Exception $e) {
        echo 'Error: Malformed URI';
    }
}

/**
 * create the object request from the
 * user request
 */
$request = new Request();

// check if the request is a valid object request
if ($request->valid) {
    // detect controller
    $controller_name = ucfirst($request->urlElements[1]) . 'Controller';

    if (class_exists($controller_name)) {

        $controller = new $controller_name();
        // detect action of the controller
        $action_name = strtolower($request->verb) . 'Action';
        /*echo '<pre>';
        print_r($request);
        echo '</pre>';
        die('pare');*/
        $result = $controller->$action_name($request);

        // detect view
        $view_name = ucfirst($request->format) . 'View';

        if (class_exists($view_name)) {
            $view = new $view_name();
            $view->render($result);
        }
    }
}
