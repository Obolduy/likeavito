<?php
namespace App\Router;

class Route
{
    private $uri;
    private $callable;
    private $middleware;

    public function __construct($uri, $callable, $middleware = null)
    {
        $this->uri = $uri;

        $this->callable = $callable;

        if ($middleware !== null) {
            $this->middleware = ucfirst($middleware);
        }
    }

    public function __get($property)
    {
        return $this->$property;
    }
}