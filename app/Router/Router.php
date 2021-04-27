<?php
namespace App\Router;
use App\Middlewares;
use App\Controllers\Controller404;

class Router
{
    public function checkRoute($routes)
    {
        $check = false;

        foreach ($routes as $elem) {
            $pregexp = '#^' . preg_replace('#/\{([^/]+)\}#', '/(?<$1>[^/]+)', $elem->uri) . '/?$#';

            if ($elem->uri === $_SERVER['REQUEST_URI']) {
                if ($elem->middleware !== null && class_exists("App\Middlewares\\$elem->middleware")) {
                    $middlewareClass = "App\Middlewares\\$elem->middleware";
                    $middleware = (new $middlewareClass)->middleware($this->uri);
                }

                if ($middleware === true || !isset($middleware)) {
                    $check = true;
                    return call_user_func($elem->callable);
                }
            }

            if (preg_match($pregexp, $_SERVER['REQUEST_URI'], $params)) {
                foreach ($params as $key => $element) {
                    if (!is_int($key)) {
                        $param[] = $element;
                    }
                }

                if ($elem->middleware !== null && class_exists("App\Middlewares\\$elem->middleware")) {
                    $middlewareClass = "App\Middlewares\\$elem->middleware";
                    $middleware = (new $middlewareClass)->middleware($this->uri);
                }

                if ($middleware === true || !isset($middleware)) {
                    $check = true;
                    return call_user_func_array($elem->callable, $param);
                }
            }
        }
        
        if ($check == false) {
            return (new Controller404)->error404();
        }
    }
}