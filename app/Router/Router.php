<?php
namespace App\Router;

use App\Controllers\Controller404;

class Router
{
    public function checkRoute($routes)
    {
        $check = false;

        $noGetUri = $_SERVER['REQUEST_URI'];

        if (preg_match('#\?(.+)=(.+)#', $noGetUri, $getMatches)) {
            $noGetUri = preg_replace("#\?(.+)=(.+)#", '', $noGetUri);

            $_GET[$getMatches[1]] = $getMatches[2];
        } else if (preg_match('#&(.+)=(.+)#', $noGetUri, $getMatches)) {
            $noGetUri = preg_replace("#\&(.+)=(.+)#", '', $noGetUri);

            for ($i = 1; $i < count($getMatches); $i++) {
                $_GET[$getMatches[$i]] = $getMatches[$i + 1];
            }
        }

        foreach ($routes as $elem) {
            $pregexp = '#^' . preg_replace('#/\{([^/]+)\}#', '/(?<$1>[^/]+)', $elem->uri) . '/?$#';

            if ($elem->uri === $noGetUri) {
                if ($elem->middleware !== null) {
                    foreach ($elem->middleware as $middlewares) {
                        $middlewareClass = "App\Middlewares\\$middlewares";
                        $middleware = (new $middlewareClass)->middleware($elem->uri);
                    }
                }

                if ($middleware === true || !isset($middleware)) {
                    $check = true;
                    return call_user_func($elem->callable);
                }
            }

            if (preg_match($pregexp, $noGetUri, $params)) {
                foreach ($params as $key => $element) {
                    if (!is_int($key)) {
                        $param[] = $element;
                    }
                }

                if ($elem->middleware !== null) {
                    foreach ($elem->middleware as $middlewares) {
                        $middlewareClass = "App\Middlewares\\$middlewares";
                        $middleware = (new $middlewareClass)->middleware($elem->uri);
                    }
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