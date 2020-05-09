<?php
// +----------------------------------------------------------------------
// | BaseController.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2020 Buffary All rights reserved.
// +----------------------------------------------------------------------
namespace Tests\App\Controllers;

use Phalcon\Mvc\Controller;

/**
 * Class BaseController
 * @package Tests\App\Controllers
 * @Milldeware('abs')
 */
abstract class BaseController extends Controller
{
    public function initialize()
    {
        $this->middleware->set([
            'abs'
        ]);
    }
}
