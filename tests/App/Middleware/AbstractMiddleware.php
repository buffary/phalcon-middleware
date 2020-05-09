<?php
// +----------------------------------------------------------------------
// | Test1Middleware.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\App\Middleware;

use Closure;
use Phalcon\Di\FactoryDefault;
use Tests\App\SortClient;
use Buffary\Phalcon\Middleware\Middleware;

class AbstractMiddleware extends Middleware
{
    public function handle($request, Closure $next)
    {
        SortClient::getInstance()->start('abs');
        $response = $next($request);
        SortClient::getInstance()->end('abs');
        return $response;
    }
}
