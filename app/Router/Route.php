<?php
namespace App\Router;

class Route
{
    private $uri;
    private $callable;

    public function __construct($uri, $callable)
    {
        $this->uri = $uri;

        $this->callable = $callable;
    }

    public function __get($property)
    {
        return $this->$property;
    }
}