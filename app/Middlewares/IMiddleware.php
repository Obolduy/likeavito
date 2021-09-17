<?php
namespace App\Middlewares;

interface IMiddleware
{
    /**
	 * If Route has Middleware property, Router get MiddlewareClass via ucfirst() and calling middleware() method
	 * @param mixed in my cases it was only URIs and IDs, that middleware need to check
	 * @return bool|void
	 */

    public function middleware($uri);
}