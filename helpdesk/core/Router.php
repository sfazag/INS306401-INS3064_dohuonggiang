<?php

class Router
{
    public function dispatch()
    {
        $page =
            $_GET['page']
            ?? 'auth';

        $action =
            $_GET['action']
            ?? 'login';

        $controllerName =
            ucfirst($page)
            .'Controller';

        $controllerFile =
            "controllers/{$controllerName}.php";

        if(!file_exists($controllerFile))
        {
            die("Controller not found");
        }

        require_once $controllerFile;

        $controller =
            new $controllerName();

        if(
            !method_exists(
                $controller,
                $action
            )
        )
        {
            die("Action not found");
        }

        $controller->$action();
    }
}