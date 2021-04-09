<?php
namespace App\Router;

class Router
{
    public function checkRoute($routes)
    {
        foreach ($routes as $elem) {
            $pregexp = '#^' . preg_replace('#/\{([^/]+)\}#', '/(?<$1>[^/]+)', $elem->uri) . '/?$#';

            if ($elem->uri === $_SERVER['REQUEST_URI']) {
                return call_user_func($elem->callable);
            }

            if (preg_match($pregexp, $_SERVER['REQUEST_URI'], $params)) {
                foreach ($params as $key => $element) {
                    if (!is_int($key)) {
                        $param[] = $element;
                    }
                }
                return call_user_func_array($elem->callable, $param);
            }
        }
    }
}