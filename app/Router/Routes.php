<?php 

include_once "Route.php";
include_once "Router.php";

function startRouter(): Router 
{
    $routes = [];
    
    include_once "Routes/UserRoutes.php";
    $routes = array_merge($routes, UserRoutes::getRoutes());

    $routesClass = [];
    foreach ($routes as $route) { 
        $routesClass[] = Route::fromArray($route);
    }
    
    return new Router($routesClass);
}
