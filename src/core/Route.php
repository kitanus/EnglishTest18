<?php
/**
 * Created by PhpStorm.
 * User: Галина
 * Date: 17.10.2018
 * Time: 11:37
 */

namespace Src\Core;

class Route
{

    public static function start()
    {
        $controller_name = 'Start';
        $action_name = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if ( !empty($routes[1]))
        {
            $controller_name = explode('?', $routes[1]);

            $controller_name = $controller_name[0];
        }

        $controller_name = 'get'.ucfirst($controller_name);
        $action_name = 'action'.ucfirst($action_name);


        $controllers = new ControllerFactory();

        $controller = call_user_func([$controllers, $controller_name], []);

        $action = $action_name;

        if(method_exists($controller, $action))
        {
            $controller->$action();
        }

    }

}