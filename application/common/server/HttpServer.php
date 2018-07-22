<?php
/**
 * Created by PhpStorm.
 * User: Skyline
 * Date: 2018/7/22
 * Time: 18:03
 */
namespace app\common\server;

use Exception;
use think\exception\Handle;

Class HttpServer extends Handle
{
    public function render(Exception $e)
    {
        parent::render($e);
        iceErrorJson();
    }
}