<?php
// +----------------------------------------------------------------------
// | TestCase.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2020 Buffary All rights reserved.
// +----------------------------------------------------------------------
namespace Tests;

use Phalcon\Di\FactoryDefault;
use PHPUnit\Framework\TestCase as UnitTestCase;
use Phalcon\Config;
use Tests\App\SortClient;
use Buffary\Phalcon\Middleware\Manager;
use Buffary\Phalcon\Middleware\Mvc\Dispatcher;
use Buffary\Phalcon\Middleware\Mvc\Dispatcher71;

class TestCase extends UnitTestCase
{
    public $di;

    /** @var Dispatcher $dispatcher */
    public $dispatcher;

    public function setUp()
    {
        $di = new FactoryDefault();
        $di->setShared('middleware', function () {
            $middlewareManager = new Manager();
            //注册中间件
            $middlewareManager->add('test', \Tests\App\Middleware\Test1Middleware::class);
            $middlewareManager->add('test2', \Tests\App\Middleware\Test2Middleware::class);
            $middlewareManager->add('test3', \Tests\App\Middleware\Test3Middleware::class);
            $middlewareManager->add('abs', \Tests\App\Middleware\AbstractMiddleware::class);
            $middlewareManager->add('second', \Tests\App\Middleware\SecondMiddleware::class);
            $middlewareManager->add('sort1', \Tests\App\Middleware\Sort1Middleware::class);
            $middlewareManager->add('sort2', \Tests\App\Middleware\Sort2Middleware::class);
            $middlewareManager->add('sort3', \Tests\App\Middleware\Sort3Middleware::class);

            return $middlewareManager;
        });

        //替换默认的dispatcher
        $di->setShared('dispatcher', function () {
            if (version_compare(PHP_VERSION, '7.1', '>=')) {
                $dispatcher = new Dispatcher71();
            } else {
                $dispatcher = new Dispatcher();
            }
            $dispatcher->setDefaultNamespace('Tests\App\Controllers');

            return $dispatcher;
        });

        $this->di = $di;

        $this->dispatcher = $di->getShared('dispatcher');

        FactoryDefault::setDefault($di);

        SortClient::getInstance()->flush();
    }
}
