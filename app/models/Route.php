<?php

class Route
{
    private $uri;
    private $controller;
    private $method;

    public function __construct($uri, $controller, $method)
    {
        $this->uri = $uri;
        $this->controller = $controller;
        $this->method = $method;
    }

    public function __get($property)
    {
        return $this->$property;
    }
}