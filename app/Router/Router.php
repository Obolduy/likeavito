<?php
namespace App\Router;
use App\Middlewares;

class Router
{
    public function checkRoute($routes)
    {
        foreach ($routes as $elem) {
            $pregexp = '#^' . preg_replace('#/\{([^/]+)\}#', '/(?<$1>[^/]+)', $elem->uri) . '/?$#';

            if ($elem->uri === $_SERVER['REQUEST_URI']) {
                if ($elem->middleware !== null) {
                    if (class_exists($elem->middleware)) {
                        $middleware = (new $elem->middleware)->middleware($this->uri);
                    }
                }
                if ($middleware === true || !isset($middleware)) {
                    return call_user_func($elem->callable);
                }
            }

            if (preg_match($pregexp, $_SERVER['REQUEST_URI'], $params)) {
                foreach ($params as $key => $element) {
                    if (!is_int($key)) {
                        $param[] = $element;
                    }
                }
                if ($elem->middleware !== null) {
                    if (class_exists("App\Middlewares\\$elem->middleware")) {
                        $middlewareClass = "App\Middlewares\\$elem->middleware";
                        $middleware = (new $middlewareClass)->middleware($this->uri);
                    }
                }
                if ($middleware === true || !isset($middleware)) {
                    return call_user_func_array($elem->callable, $param);
                }
            }
        }
    }
}