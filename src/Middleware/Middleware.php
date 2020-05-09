<?php

namespace Buffary\Phalcon\Middleware;

use Phalcon\Di\Injectable;
use Closure;

abstract class Middleware extends Injectable
{
    abstract public function handle($request, Closure $next);
}
