<?php

require_once 'classes.php';

interface MiddlewareInterface
{
    public static function testFunc($uri);
}