<?php
namespace App\Router;

class Route
{
    private $uri;
    private $callable;

    public function __construct($uri, $callable)
    {
        // доделать
        // $match = '';
        // if (preg_match('#%7B(.+)%7D#', $uri, $test)) {
        //     preg_replace()
        //     $this->uri = $match[1];
        // } else {
            $this->uri = $uri;
        // }
        $this->callable = $callable;
    }

    public function __get($property)
    {
        return $this->$property;
    }
}